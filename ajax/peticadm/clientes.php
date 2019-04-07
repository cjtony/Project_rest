<?php

session_start();

if ($_SESSION['keyAdm'] == "" || $_SESSION['keyAdm'] == null) {
	header("Location:../../");
} else {
	include '../../models/rutas.php';
	include '../../models/connect.php';
	$fechAct = date("Y-m-d");
	$dbConexion = new Connect();
	$dbConexion = $dbConexion -> getDB();
	$keyAdm = $_SESSION['keyAdm'];
	switch ($_GET['oper']) {
		
		case 'desEmp':

			$clvCli = isset($_POST['clvCli']) ? trim($_POST['clvCli']) : "";
			$desact = 0;
			try {
				$update = $dbConexion -> prepare("UPDATE clientes SET estado_cli = :desact WHERE id_cliente = :clvCli");
				$update -> bindParam("desact", $desact, PDO::PARAM_INT);
				$update -> bindParam("clvCli", $clvCli, PDO::PARAM_INT);
				$update -> execute();
				if ($update) {
					echo 1;
				} else {
					echo "Fallo la desactivación";
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null;
			}

			break;

		case 'actEmp':

			$clvCli = isset($_POST['clvCli']) ? trim($_POST['clvCli']) : "";
			$active = 1;
			try {
				$update = $dbConexion -> prepare("UPDATE clientes SET estado_cli = :active WHERE id_cliente = :clvCli");
				$update -> bindParam("active", $active, PDO::PARAM_INT);
				$update -> bindParam("clvCli", $clvCli, PDO::PARAM_INT);
				$update -> execute();
				if ($update) {
					echo 1;
				} else {
					echo "Fallo la activación";
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null;
			}

			break;

		case 'changepassuser':
			$clvUser = isset($_POST['clvUser']) ? trim($_POST['clvUser']) : "";
			$passAct = isset($_POST['passAct']) ? trim($_POST['passAct']) : "";
			$newPass = isset($_POST['newPass']) ? trim($_POST['newPass']) : "";
			$passAct = md5($passAct); 
			$newPass = md5($newPass);
			try {
				$validPass = $dbConexion -> prepare("SELECT * FROM usuarios WHERE pass = :passAct AND id_usuario = :keyAdm");
				$validPass -> bindParam("passAct", $passAct, PDO::PARAM_STR);
				$validPass -> bindParam("keyAdm", $keyAdm, PDO::PARAM_INT);
				$validPass -> execute();
				$rowValidPass = $validPass -> rowCount();
				if ($rowValidPass == 1) {
					$updPass = $dbConexion -> prepare("UPDATE usuarios SET pass = :newPass WHERE id_usuario = :clvUser");
					$updPass -> bindParam("newPass", $newPass, PDO::PARAM_STR);
					$updPass -> bindParam("clvUser", $clvUser, PDO::PARAM_INT);
					$updPass -> execute();
					if ($updPass) {
						echo 1;
					} else {
						echo "Fallo la actualización";
					}
				} else {
					echo "La contraseña actual es incorrecta";
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null;
			}
			break;

		default:
			$dbConexion = null;
			break;
	}

}
