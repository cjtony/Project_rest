<?php

session_start();

if ($_SESSION['keyCli'] == "" || $_SESSION['keyCli'] == null) {
	header("Location:../../");
} else {
	include '../../models/rutas.php';
	include '../../models/connect.php';
	$fechAct = date("Y-m-d");
	$dbConexion = new Connect();
	$dbConexion = $dbConexion -> getDB();
	$keyCli = $_SESSION['keyCli'];
	switch ($_GET['oper']) {
	
		case 'changepass':

			$passAct = isset($_POST['passAct']) ? trim($_POST['passAct']) : "";
			$newPass = isset($_POST['newPass']) ? trim($_POST['newPass']) : "";
			$passAct = md5($passAct); 
			$newPass = md5($newPass);
			try {
				$validPass = $dbConexion -> prepare("SELECT * FROM clientes WHERE password = :passAct AND id_cliente = :keyCli");
				$validPass -> bindParam("passAct", $passAct, PDO::PARAM_STR);
				$validPass -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
				$validPass -> execute();
				$rowValidPass = $validPass -> rowCount();
				if ($rowValidPass == 1) {
					$updPass = $dbConexion -> prepare("UPDATE clientes SET password = :newPass WHERE id_cliente = :keyCli");
					$updPass -> bindParam("newPass", $newPass, PDO::PARAM_STR);
					$updPass -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
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

		case 'changedata':
			
			$nameUs = isset($_POST['nameUs']) ? trim($_POST['nameUs']) : "";
			$corUs = isset($_POST['corUs']) ? trim($_POST['corUs']) : "";
			$telUs = isset($_POST['telUs']) ? trim($_POST['telUs']) : "";
			$userUs = isset($_POST['userUs']) ? trim($_POST['userUs']) : "";
			$pasUs = isset($_POST['pasUs']) ? trim($_POST['pasUs']) : "";
			$pasUs = md5($pasUs);

			try {
				$validCor = $dbConexion -> prepare("SELECT * FROM clientes WHERE correo_cli = :corUs && id_cliente != :keyCli");
				$validCor -> bindParam("corUs", $corUs, PDO::PARAM_STR);
				$validCor -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
				$validCor -> execute();
				$rowValidCor = $validCor -> rowCount();
				if ($rowValidCor == 1) {
					echo "El correo ya se encuentra registrado";
				} else {
					$validUser = $dbConexion -> prepare("SELECT * FROM clientes WHERE usuario_cli = :userUs && id_cliente != :keyCli");
					$validUser -> bindParam("userUs", $userUs, PDO::PARAM_STR);
					$validUser -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
					$validUser -> execute();
					$rowValidUser = $validUser -> rowCount();
					if ($rowValidUser == 1) {
						echo "El usuario ya se encuentra registrado";
					} else {
						$validPhone = $dbConexion -> prepare("SELECT * FROM clientes WHERE telefono_cli = :telUs && id_cliente != :keyCli");
						$validPhone -> bindParam("telUs", $telUs, PDO::PARAM_STR);
						$validPhone -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
						$validPhone -> execute();
						$rowValidPhone = $validPhone -> rowCount();
						if ($rowValidPhone == 1) {
							echo "El telefono ya se encuentra registrado";
						} else {
							$validPass = $dbConexion -> prepare("SELECT * FROM clientes WHERE password = :pasUs && id_cliente = :keyCli");
							$validPass -> bindParam("pasUs", $pasUs, PDO::PARAM_STR);
							$validPass -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
							$validPass -> execute();
							$rowValidPass = $validPass -> rowCount();
							if ($rowValidPass == 1) {
								$updData = $dbConexion -> prepare("UPDATE clientes SET nombre_cli = :nameUs, telefono_cli = :telUs,  correo_cli = :corUs, usuario_cli = :userUs WHERE id_cliente = :keyCLi");
								$updData -> bindParam("nameUs", $nameUs, PDO::PARAM_STR);
								$updData -> bindParam("telUs", $telUs, PDO::PARAM_STR);
								$updData -> bindParam("corUs", $corUs, PDO::PARAM_STR);
								$updData -> bindParam("userUs", $userUs, PDO::PARAM_STR);
								$updData -> bindParam("keyCLi", $keyCLi, PDO::PARAM_STR);
								$updData -> execute();
								if ($updData) {
									echo 1;
								} else {
									echo "Fallo la actualización";
								}
							} else {
								echo "La contraseña ingresada es incorrecta";
							}
						}
					}
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
