<?php 

$cod = explode("/", $_GET['view']);
$valRec = $cod[1];

?>

<div class="container-fluid animated fadeIn delay-1s mt-4">
	
	<h3 class="text-center font-weight-bold">
		Pedido: <a style="text-decoration: underline;"><?php echo $valRec; ?></a>
	</h3>
	
	<hr>

	<div class="row">
		<div class="col-sm-7">
			<div class="row">
				<?php 
					$dbc = new Connect();
					$dbc = $dbc -> getDB();
					$dataPed = $dbc -> prepare("SELECT dp.id_detpedido, dp.confirm_ped, dp.fecha_hora_ped, car.fecha_dat, car.estad_car, pm.nombre_plat, pm.descripcion_plat, pm.precio_plat, pm.imagen_plat1, ct.nombre_cat, cl.nombre_cli, cl.telefono_cli, dr.direccion_cli, dr.referencia_cli, dr.num_ext, dr.num_int FROM det_pedido dp  INNER JOIN carrito car ON car.id_carrito = dp.id_carrito INNER JOIN plat_menu pm ON pm.id_platillo = car.id_platillo INNER JOIN categoria ct ON ct.id_categoria = pm.id_categoria INNER JOIN clientes cl ON cl.id_cliente = car.id_cliente INNER JOIN direcciones dr ON dr.id_direccion = dp.id_direccion WHERE dp.cod_conf = :valRec");
					$dataPed -> bindParam("valRec", $valRec, PDO::PARAM_STR);
					$dataPed -> execute();
					while ($dp = $dataPed -> fetch(PDO::FETCH_OBJ)) {
				?>
					<div class="col-sm-6 p-2">
						<div class="border rounded border-success shadow p-2 bg-white">
							<h5 class="card-title text-center font-weight-bold mt-3">
								<?php echo $dp->nombre_plat; ?>
							</h5>
							<hr>
							<div class="text-center mb-3 mt-3">
								<img src="<?php echo SERVERURL; ?>files/platillos/<?php echo $dp->imagen_plat1; ?>" width="150" class="rounded shadow" alt="">
							</div>
							<hr>
							<p class="text-justify">
								<?php echo $dp->descripcion_plat; ?>
							</p>
							<hr>
							<div class="text-left">
								<b>Precio: <i class="fas fa-dollar-sign mr-2"></i> <?php echo $dp->precio_plat; ?> </b>
								<br>
								<b>Categoría: </i> <?php echo $dp->nombre_cat; ?> </b>
							</div>
						</div>
					</div>
				<?php
					}
				?>
			</div>
		</div>
		<div class="col-sm-5 mt-3">
			<?php 
				$datPedido = $dbc -> prepare("SELECT dp.confirm_ped, dp.fecha_hora_ped, cl.nombre_cli, cl.telefono_cli, dr.direccion_cli, dr.referencia_cli, dr.num_ext, dr.num_int FROM det_pedido dp  INNER JOIN carrito car ON car.id_carrito = dp.id_carrito INNER JOIN plat_menu pm ON pm.id_platillo = car.id_platillo INNER JOIN categoria ct ON ct.id_categoria = pm.id_categoria INNER JOIN clientes cl ON cl.id_cliente = car.id_cliente INNER JOIN direcciones dr ON dr.id_direccion = dp.id_direccion WHERE dp.cod_conf = :valRec LIMIT 1");
				$datPedido -> bindParam("valRec", $valRec, PDO::PARAM_STR);
				$datPedido -> execute();
				$dped = $datPedido -> fetch(PDO::FETCH_OBJ);
			?>
			<div class="rounded p-5 shadow">
				<h6 class="text-left mt-2">
					Dirección de entrega:
					<b>
						<?php echo $dped -> direccion_cli; ?>
					</b>
				</h6>
				<h6 class="text-left mt-2">
					Referencia:
					<b>
						<?php echo $dped -> direccion_cli; ?>
					</b>
				</h6>
				<h6 class="text-left mt-2">
					Num Exterior:
					<b>
						<?php echo $dped -> num_int; ?>
					</b>
				</h6>
				<h6 class="text-left mt-2">
					Num Interior:
					<b>
						<?php echo $dped -> num_ext; ?>
					</b>
				</h6>
				<hr>
				<h6 class="text-center mt-2">
					Cliente:
					<b>
						<?php echo $dped -> nombre_cli; ?>
					</b>
				</h6>
				<h6 class="text-center mt-2">
					Fecha y hora del pedido
					<b>
						<?php echo $dped -> fecha_hora_ped; ?>
					</b>
				</h6>
				<h6 class="text-center mt-2">
					<span class="mr-2">Total a pagar</span>
					<b>
						<?php 
							$sumTot = $dbc -> prepare("SELECT SUM(pm.precio_plat) AS 'precio_plat' FROM det_pedido dp INNER JOIN carrito car ON car.id_carrito = dp.id_carrito INNER JOIN plat_menu pm ON pm.id_platillo = car.id_platillo WHERE dp.cod_conf = :valRec");
							$sumTot -> bindParam("valRec", $valRec, PDO::PARAM_STR);
							$sumTot -> execute();
							$resTot = $sumTot -> fetch(PDO::FETCH_OBJ);
						?>
						<span class="badge badge-success p-2">
							<i class="fas fa-dollar-sign "></i>
							<?php echo $resTot->precio_plat; ?>
						</span>
					</b>
				</h6>
				<div class="text-center mt-4">
					<?php 
						if ($dped -> confirm_ped == 1) {
					?>
						<button class="btn btn-success btn-sm" onclick="confirm('<?php echo $valRec; ?>')">
							Confirmar pedido
						</button>
					<?php
						} else {
					?>	
						<b class="text-info">El pedido ya ha sido confirmado</b>
					<?php
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo SERVERURLADM; ?>js/confirmped.js"></script>