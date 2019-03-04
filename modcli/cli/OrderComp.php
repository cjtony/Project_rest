<?php 

$datCar = $climodel -> orderComp($keyCli,1);
$datDir = $climodel -> direccCli($keyCli);


?>

<div class="container-fluid animated fadeIn delay-1s mt-4">
	
	<h3 class="text-center text-muted">
		Termina de completar la información y enseguida tu pedido sera completado...
	</h3>

	<hr>
	
	<div class="row mt-4">
		<div class="col-sm-6">
			<div class="row" id="ordcar">
			</div>
		</div>
		<div class="col-sm-1"></div>
		<div class="col-sm-5">
			<div class="">
				<h4 class="text-center">Información de pedido</h4>
				<?php 
					if ($datDir -> rowCount() > 0) {
				?>
					<form class="mt-3" id="formCP">
						<div class="form-group mb-4">
							<label for="dirEnv">Dirección de envío</label>
							<select id="dirEnv" name="dirEnv" class="form-control">
								<option selected="" value="0">Selecciona</option>
								<?php 
									while ($dat = $datDir -> fetch(PDO::FETCH_OBJ)) {
								?>
								<option value="<?php echo $dat->id_direccion; ?>">
									<?php echo $dat->direccion_cli.", ext: ".$dat->num_ext.", int: ".$dat->num_int.", ref: ".$dat->referencia_cli; ?>
								</option>
								<?php
									}
								?>
							</select>
						</div>
						<div class="form-group mb-4">
							<label for="pascon" class="text-primary font-weight-bold">Introduce tu contraseña para confirmar el pedido</label>
							<input type="password" id="pasCon" name="pasCon" class="form-control">
						</div>
						<div class="text-center mb-4">
							<button class="btn btn-primary btn-sm" id="btnEnv">
								Confirmar pedido
							</button>
						</div>
					</form>
				<?php
					} else {
				?>
					<br>
					<div class="text-center mt-5">
						<h5 class="text-danger"> No tienes ninguna dirección registrada, registra alguna para continuar con la confirmación del pedido</h5>
						<br>
						<a href="<?php echo SERVERURLCLI; ?>Directions/" class="btn btn-sm btn-primary">
							Registrar dirección
						</a>
					</div>
				<?php
					}
				?>
			</div>
		</div>
	</div>
	
	<script src="<?php echo SERVERURLCLI; ?>js/ordcar.js"></script>

</div>