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

		case 'mostpre':
			
			try {
				$stmt = $bd -> prepare("SELECT SUM(pt.precio_plat) AS 'Total' FROM carrito cr INNER JOIN plat_menu pt ON pt.id_platillo = cr.id_platillo INNER JOIN clientes cl ON cl.id_cliente = cr.id_cliente INNER JOIN categoria ct ON ct.id_categoria = pt.id_categoria WHERE cl.id_cliente = :keyCli && cr.estad_car = :valid");
				$stmt -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
				$stmt -> execute();
				$salida = "";
				$resstmt = $stmt -> rowCount();
				$dat = $stmt -> fetch(PDO::FETCH_OBJ);
				if ($dat->Total != Null){
					$salida .= "
							<span class='badge badge-primary'>Total: $".$dat->Total."</span>";
				}
				echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$bd = null; $stmt = null; $resstmt = null; $salida = null;
			}

			break;

        case 'mostord':
			
			try {
				$stmt = $bd -> prepare("SELECT * FROM carrito cr INNER JOIN plat_menu pt ON pt.id_platillo = cr.id_platillo INNER JOIN clientes cl ON cl.id_cliente = cr.id_cliente INNER JOIN categoria ct ON ct.id_categoria = pt.id_categoria WHERE cl.id_cliente = :keyCli && cr.estad_car = :valid");
				$stmt -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
				$stmt -> execute();
				$salida = "";
				$resstmt = $stmt -> rowCount();
				if ($resstmt > 0){
					$salida .= '<a href="'.SERVERURLCLI.'OrderComp/" class="nav-link font-weight-bold text-success" id="mostord">Ordenar</a>';
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
				$stmt = $bd -> prepare("SELECT COUNT(id_carrito) as 'Cantidad' FROM carrito WHERE id_cliente = :keyCli && estad_car = :valid");
				$stmt -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
				$stmt -> bindParam("valid", $valid, PDO::PARAM_INT);
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

		case 'ordcar':
			
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
							<div class="col-sm-6">
								<div class="card shadow mb-4 p-3">
									<i class="fas fa-circle text-primary mb-3"></i>
									<div class="text-center mb-3">
										<img src="'.SERVERURL.'/fotmenu/'.$dat->imagen_plat1.'" class="rounded img-fluid" width="130" />
									</div>
									<div class="card-header text-center h5">'.$dat->nombre_plat.'</div>
									<div class="card-body">
										<b>Descripción:</b>
										<p class="text-muted mt-2">'.$dat->descripcion_plat.'</p>
									</div>
									<div class="row">
										<div class="col-sm-6 text-center">
											<b><span class="badge badge-primary">'.$dat->nombre_cat.'</span> </b> 
										</div>
										<div class="col-sm-6 text-center">
											<b>Precio: <span class="badge badge-primary">$'.$dat->precio_plat.'</span> </b> 
										</div>
									</div>
								</div>
							</div>
						' ;
					}
				} else {
					$salida .= '';
				}
				echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$bd = null; $stmt = null; $resstmt = null; $salida = null;
			}

			break;

		case 'cantNotif':
			try {
                $confirm = 0;
                $exec = $bd -> prepare("SELECT DISTINCTROW dp.cod_conf FROM det_pedido dp INNER JOIN carrito cr ON cr.id_carrito = dp.id_carrito INNER JOIN clientes cl ON cl.id_cliente = cr.id_cliente WHERE dp.confirm_ped = :confirm && DATE(dp.fecha_hora_ped) = :fechAc && cl.id_cliente = :keyCli");
                $exec -> bindParam("confirm", $confirm, PDO::PARAM_INT);
                $exec -> bindParam("fechAc", $fechAc, PDO::PARAM_STR);
                $exec -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
                $exec -> execute();
                $rowCantNotif = $exec -> rowCount();
                if ($rowCantNotif > 0) {
                	echo $rowCantNotif;
                } else {
                	echo 0;
                }
			} catch (PDOException $e) {
				echo $e-getMessage();
			} finally {
				$bd = null;
			}
			break;

		case 'listNotif':
			
			try {
				$confirm = 0;
                $exec = $bd -> prepare("SELECT DISTINCTROW dp.cod_conf AS 'COD' FROM det_pedido dp INNER JOIN carrito cr ON cr.id_carrito = dp.id_carrito INNER JOIN clientes cl ON cl.id_cliente = cr.id_cliente WHERE dp.confirm_ped = :confirm && DATE(dp.fecha_hora_ped) = :fechAc && cl.id_cliente = :keyCli");
                $exec -> bindParam("confirm", $confirm, PDO::PARAM_INT);
                $exec -> bindParam("fechAc", $fechAc, PDO::PARAM_STR);
                $exec -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
                $exec -> execute();
                $rowCantNotif = $exec -> rowCount();
                if ($rowCantNotif > 0) {
                	$salida = '';
                	while ($data = $exec -> fetch(PDO::FETCH_OBJ)) {
                		$codigo = $data->COD;
                		$result = $bd -> prepare("SELECT * FROM det_pedido WHERE cod_conf = :codigo LIMIT 1");
                		$result -> bindParam("codigo", $codigo, PDO::PARAM_STR);
                		$result -> execute();
                		while ($dt = $result -> fetch(PDO::FETCH_OBJ)) {
                			$salida .= '
								<a class="dropdown-item font-weight-bold" href="'.SERVERURLCLI.'detOrder/'.$dt->cod_conf.'/">
					              <span class="badge badge-primary p-2">
					              	El pedido
					              	'.$dt->cod_conf.'
					              </span>
					              <div class="text-center mt-1">
									<small class="ml-0 pl-0 mr-2 font-weight-bold">
										<i class="fas fa-check mr-2 text-primary"></i>Fue confirmado.
									</small>
					              </div>
					            </a>
					            <div class="dropdown-divider"></div>
							' ;
                		}
                	}
                } else {
                	echo 0;
                }
                echo $salida;
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$bd = null;
			}

			break;

		default:
			$bd = null;
			break;

	}
}