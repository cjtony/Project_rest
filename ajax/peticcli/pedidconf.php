<?php 

session_start();

if ($_SESSION['keyCli'] == "" || $_SESSION['keyCli'] == null) {
	header("Location:../../Index.php");
} else {

	include '../../models/connect.php';
	include '../../models/rutas.php';

	$keyCli = $_SESSION['keyCli'];
	$fechAc = date("Y-m-d");
	$valid = 1;
	$confirm = 0;
	$fechhor = date("Y-m-d H:i:s");

	$bd = new Connect();
	$bd = $bd -> getDB();

	function generarCodigo($longitud) {
		$key = '';
		$pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
		$max = strlen($pattern)-1;
		for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
		return 'PED'.$key;
	}

	switch ($_GET['oper']) {

		case 'confped':

			$dirEnv = isset($_POST['dirEnv']) ? trim($_POST['dirEnv']) : "";
			$pasCon = isset($_POST['pasCon']) ? trim($_POST['pasCon']) : "";
			$pasConEn = sha1($pasCon);
			$codconf = generarCodigo(6);

			try {
				$confvalid = $bd -> prepare("SELECT * FROM clientes WHERE id_cliente = :keyCli && password = :pasConEn");
				$confvalid -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
				$confvalid -> bindParam("pasConEn", $pasConEn, PDO::PARAM_STR);
				$confvalid -> execute();
				$resuvalid = $confvalid -> rowCount();
				if ($resuvalid == 1) {
					$stmt = $bd -> prepare("SELECT * FROM carrito cr INNER JOIN plat_menu pt ON pt.id_platillo = cr.id_platillo  INNER JOIN clientes cl ON cl.id_cliente = cr.id_cliente INNER JOIN categoria ct ON ct.id_categoria = pt.id_categoria WHERE cl.id_cliente = :keyCli && cr.estad_car = :valid");
					$stmt -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
					$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
					$stmt -> execute();
					if ($stmt -> rowCount() > 0) {
						while ($dat = $stmt -> fetch(PDO::FETCH_OBJ)) {
							$id_carr = $dat -> id_carrito;
							$ins = $bd -> prepare("INSERT INTO det_pedido (id_carrito, id_direccion, confirm_ped, fecha_hora_ped, cod_conf) VALUES (:id_carr, :dirEnv, :valid, :fechhor, :codconf)");
							$ins -> bindParam("id_carr", $id_carr, PDO::PARAM_INT);
							$ins -> bindParam("dirEnv", $dirEnv, PDO::PARAM_INT);
							$ins -> bindParam("valid", $valid, PDO::PARAM_INT);
							$ins -> bindParam("fechhor", $fechhor, PDO::PARAM_STR);
							$ins -> bindParam("codconf", $codconf, PDO::PARAM_INT);
							$ins -> execute();
							if ($ins) {
								$upd = $bd -> prepare("UPDATE carrito SET estad_car = :confirm WHERE id_carrito = :id_carr && id_cliente = :keyCli");
								$upd -> bindParam("confirm", $confirm, PDO::PARAM_INT);
								$upd -> bindParam("id_carr", $id_carr, PDO::PARAM_INT);
								$upd -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
								$upd -> execute();
								if ($upd) {
									echo "bien";
								}
							} else {
								echo "";
							}
						}
					} else {
						echo 0;
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
			break;

	}
}