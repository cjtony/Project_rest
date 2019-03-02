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

	$bd = new Connect();
	$bd = $bd -> getDB();

	switch ($_GET['oper']) {

		case 'addcar':

			$clv_plat = isset($_POST['clv_plat']) ? trim($_POST['clv_plat']) : "";

			try {
				$stmt = $bd -> prepare("INSERT INTO carrito (id_platillo, id_cliente, fecha_dat, estad_car) VALUES (:clv_plat, :keyCli, :fechAc, :valid)");
				$stmt -> bindParam("clv_plat", $clv_plat, PDO::PARAM_INT);
				$stmt -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
				$stmt -> bindParam("fechAc", $fechAc, PDO::PARAM_STR);
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
				$res = $stmt -> execute();
				if ($res) {
					echo 1;
				} else {
					echo 0;
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$bd = null; $stmt = null;
			}

			break;

		case 'mostcar':
			
			try {
				$stmt = $bd -> prepare("SELECT * FROM carrito cr INNER JOIN plat_menu pt ON pt.id_platillo = cr.id_platillo  INNER JOIN clientes cl ON cl.id_cliente = cr.id_cliente INNER JOIN categoria ct ON ct.id_categoria = pt.id_categoria WHERE cl.id_cliente = :keyCli && cr.estad_car = :valid");
				$stmt -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
				$stmt -> execute();
				$salida = "";
				$resstmt = $stmt -> rowCount();
				if ($resstmt > 0){
					while ($dat = $stmt -> fetch(PDO::FETCH_OBJ)) {
						$salida .= '
							<div class="text-right mr-2 p-0 mt-0">
								<i style="cursor:pointer;" class="fas fa-times-circle text-danger" onclick=elimcar('.$dat->id_carrito.')></i>
							</div>
							<a class="dropdown-item font-weight-bold" href="#">
				              '.$dat->nombre_plat.'
				              <span class="badge badge-primary ml-2">$'.$dat->precio_plat.'</span>
				            </a>
				            <div class="dropdown-divider"></div>
						' ;
					}
				} else {
					$salida .= "<div class='text-center'>
						<a class='dropdown-item'>
							<span class='badge badge-primary ml-2' style='font-size:16px;'>Tu carrito esta vacío.</span>
						</a>
					</div>";
				}
				echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$bd = null; $stmt = null; $resstmt = null; $salida = null;
			}

			break;

		case 'cantcar':
			
			try {
				$stmt = $bd -> prepare("SELECT COUNT(id_carrito) as 'Cantidad' FROM carrito WHERE id_cliente = :keyCli");
				$stmt -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
				$stmt -> execute();
				$salida = "";
				$resstmt = $stmt -> rowCount();
				while ($dat = $stmt -> fetch(PDO::FETCH_OBJ)) {
					$salida = $dat->Cantidad;
				}
			echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$bd = null; $stmt = null; $resstmt = null; $salida = null;
			}

			break;

		case 'elimcar':
			
			echo $param = isset($_POST['param']) ? trim($_POST['param']) : "";

			try {
				$stmt = $bd -> prepare("DELETE FROM carrito WHERE id_cliente = :keyCli && id_carrito = :param");
				$stmt -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
				$stmt -> bindParam("param", $param, PDO::PARAM_INT);
				$stmt -> execute();
				if ($stmt) {
					echo "bien";
				} else {
					echo "mal";
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