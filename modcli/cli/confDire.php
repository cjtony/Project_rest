<div class="container-fluid animated fadeIn delay-1s">
	
	<h1 class="text-center font-weight-bold">
		Mis direcciones
	</h1>

	<div class="row mt-5">
		<div class="col-sm-6">
			<h4 class="text-center text-info">
				Mis direcciones
			</h4>
			<?php 
				$dbc = new Connect();
				$dbc = $dbc -> getDB();
				$query = $dbc -> prepare("SELECT * FROM direcciones dr INNER JOIN clientes cl ON cl.id_cliente = dr.id_cliente WHERE cl.id_cliente = :keyCli");
				$query -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
				$query -> execute();
				$rowQuery = $query -> rowCount();
				if ($rowQuery > 0) {
					while ($dt = $query -> fetch(PDO::FETCH_OBJ)) {
			?>
					<div class="rounded shadow border border-info mt-4 p-3">
						<b>
							Direccion: <?php echo $dt->direccion_cli; ?>.
						</b> 
						<br>
						<b>
							Referencia: <?php echo $dt->referencia_cli; ?>.
						</b>
						<br>
						<div class="row mt-2">
							<div class="col-sm-6 text-center">
								<b>Num Int: <?php echo $dt->num_int; ?> </b>
							</div>
							<div class="col-sm-6 text-center">
								<b>Num Ext: <?php echo $dt->num_ext; ?> </b>
							</div>
							<div class="col-sm-12 mt-4 text-center">
								<a href="<?php echo SERVERURLCLI; ?>editDir/<?php echo $dt->id_direccion; ?>/" class="btn btn-primary btn-sm">
									Editar
								</a>
							</div>
						</div>
					</div>
			<?php
					}
				} else {
			?>
				<div class="rounded shadow border border-danger p-3 text-center mt-5">
					No tienes ninguna dirección registrada.
				</div>
			<?php
				}
			?>
		</div>
		<div class="col-sm-6">
			<h4 class="text-center text-info">
				Nueva direccion
			</h4>
			<form class="mt-1 p-5" id="formDat" autocomplete="off">
				<div class="form-group">
					<label>Direccion</label>
					<input type="text" class="form-control" name="direc" id="direc" required="">
				</div>
				<div class="form-group">
					<label>Referencia</label>
					<input type="text" class="form-control" name="refec" id="refec" required="">
				</div>
				<div class="form-group">
					<label>Numero exterior</label>
					<input type="text" class="form-control" name="numext" id="numext">
				</div>
				<div class="form-group">
					<label>Numero interior</label>
					<input type="text" class="form-control" name="numint" id="numint">
				</div>
				<div class="form-group text-center mt-4">
					<button class="btn-md btn btn-success" type="submit" id="butnAct">
						Registrar
					</button>
					<div class="d-none" id="mosLoad">
						<div class="spinner-border text-success" role="status" style="width: 2rem; height: 2rem;">
					  		<span class="sr-only">Loading...</span>
						</div>
						<h5 class="text-center mt-2 spacing5">
							<b>Registrando...</b>
						</h5>
					</div>
					<div class="mt-4 d-none" id="mosGood">
						<h5 class="text-center text-success font-weight-bold">
							<i class="fas fa-check mr-2"></i>
							Datos registrados
						</h5>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?php echo SERVERURLCLI; ?>js/direct.js"></script>