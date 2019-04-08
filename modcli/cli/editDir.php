<?php 

$cod = explode("/", $_GET['view']);
$valRec = $cod[1];
$dbc = new Connect();
$dbc = $dbc -> getDB();
$info = $dbc -> prepare("SELECT * FROM direcciones WHERE id_direccion = :valRec");
$info -> bindParam("valRec", $valRec, PDO::PARAM_INT);
$info -> execute();
$data = $info -> fetch(PDO::FETCH_OBJ);
?>

<div class="container-fluid animated fadeIn delay-1s mt-4">
	
	<h1 class="text-center font-weight-bold">
		Editar dirección
	</h1>

	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<form class="mt-1 p-5" id="formDat" autocomplete="off">
				<div class="form-group">
					<input type="hidden" readonly value="<?php echo $data->id_direccion; ?>" name="id_dir">
					<label>Direccion</label>
					<input type="text" class="form-control" value="<?php echo $data->direccion_cli; ?>" name="direc" id="direc" required="">
				</div>
				<div class="form-group">
					<label>Referencia</label>
					<input type="text" class="form-control" value="<?php echo $data->referencia_cli; ?>" name="refec" id="refec" required="">
				</div>
				<div class="form-group">
					<label>Numero exterior</label>
					<input type="text" class="form-control" value="<?php echo $data->num_ext; ?>" name="numext" id="numext">
				</div>
				<div class="form-group">
					<label>Numero interior</label>
					<input type="text" class="form-control" value="<?php echo $data->num_int; ?>" name="numint" id="numint">
				</div>
				<div class="form-group text-center mt-4">
					<button class="btn-md btn btn-success" type="submit" id="butnAct">
						Actualizar
					</button>
					<div class="d-none" id="mosLoad">
						<div class="spinner-border text-success" role="status" style="width: 2rem; height: 2rem;">
					  		<span class="sr-only">Loading...</span>
						</div>
						<h5 class="text-center mt-2 spacing5">
							<b>Actualizando...</b>
						</h5>
					</div>
					<div class="mt-4 d-none" id="mosGood">
						<h5 class="text-center text-success font-weight-bold">
							<i class="fas fa-check mr-2"></i>
							Datos actualizados
						</h5>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?php echo SERVERURLCLI; ?>js/confdirect.js"></script>