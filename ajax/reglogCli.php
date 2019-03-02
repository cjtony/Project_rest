<?php 

include '../models/connect.php';

$bd = new Connect();
$bd = $bd -> getDB();
$fechAc = date("Y-m-d");

switch ($_GET['oper']) {

	case 'register':

		$nameUs = isset($_POST['nameUs']) ? trim($_POST['nameUs']) : "";
		$teleUs = isset($_POST['teleUs']) ? trim($_POST['teleUs']) : "";
		$mailUs = isset($_POST['mailUs']) ? trim($_POST['mailUs']) : "";
		$userUs = isset($_POST['userUs']) ? trim($_POST['userUs']) : "";
		$passUs = isset($_POST['passUs']) ? trim($_POST['passUs']) : "";
		$passEn = sha1($passUs);
		$nameUs = ucfirst($nameUs);

		try {
			$valid1 = $bd -> prepare("SELECT * FROM clientes WHERE correo_cli = :mailUs");
			$valid1 -> bindParam("mailUs", $mailUs, PDO::PARAM_STR);
			$valid1 -> execute();
			$rowValid1 = $valid1 -> rowCount();
			if ($rowValid1 == 1) {
				echo 490;
			} else {
				$valid2 = $bd -> prepare("SELECT * FROM clientes WHERE usuario_cli = :userUs");
				$valid2 -> bindParam("userUs", $userUs, PDO::PARAM_STR);
				$valid2 -> execute();
				$rowValid2 = $valid2 -> rowCount();
				if ($rowValid2 == 1) {
					echo 480;
				} else {
					$stmt = $bd -> prepare("INSERT INTO clientes (nombre_cli, telefono_cli, correo_cli, usuario_cli, password, fecha_reg_cli) VALUES (:nameUs, :teleUs, :mailUs, :userUs, :passEn, :fechAc)");
					$stmt -> bindParam("nameUs", $nameUs, PDO::PARAM_STR);
					$stmt -> bindParam("teleUs", $teleUs, PDO::PARAM_STR);
					$stmt -> bindParam("mailUs", $mailUs, PDO::PARAM_STR);
					$stmt -> bindParam("userUs", $userUs, PDO::PARAM_STR);
					$stmt -> bindParam("passEn", $passEn, PDO::PARAM_STR);
					$stmt -> bindParam("fechAc", $fechAc, PDO::PARAM_STR);
					$dataIns = $stmt -> execute();
					if ($dataIns) {
						echo 1;
					} else {
						echo 2;
					}
				}
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		} finally {
			$bd = null; $valid1 = null; $valid2 = null; $stmt = null;
		}

		break;

	case 'login':

		$userUs = isset($_POST['userUs']) ? trim($_POST['userUs']) : "";
		$passUs = isset($_POST['passUs']) ? trim($_POST['passUs']) : "";
		$passEn = sha1($passUs);

		try {
			$stmt = $bd -> prepare("SELECT * FROM clientes WHERE usuario_cli = :userUs && password = :passEn");
			$stmt -> bindParam("userUs", $userUs, PDO::PARAM_STR);
			$stmt -> bindParam("passEn", $passEn, PDO::PARAM_STR);
			$stmt -> execute();
			$rowStmt = $stmt -> rowCount();
			if ($rowStmt === 1) {
				session_start();
				$rowDat = $stmt -> fetch(PDO::FETCH_OBJ);
				$keyCli = $rowDat->id_cliente;
				$stmtFech = $bd -> prepare("UPDATE clientes SET fech_activ_cli = :fechAc WHERE id_cliente = :keyCli");
				$stmtFech -> bindParam("fechAc", $fechAc, PDO::PARAM_STR);
				$stmtFech -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
				$stmtFech -> execute();
				if ($rowDat) {
					$_SESSION['keyCli'] = $keyCli;
					echo 1;
				} else {
					echo 3;
				}
			} else {
				echo 2;
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		} finally {
			$bd = null; $stmt = null;
		}

		break;
	
	default:
		$bd = null;
		die();
		break;

}