<?php 

$cod = explode("/", $_GET['view']);
$valRec = $cod[1];
try {
	$dbc = new Connect();
	$dbc = $dbc -> getDB();
	$val = $dbc -> prepare("SELECT * FROM admin WHERE id_admin = :valRec");
	$val -> bindParam("valRec", $valRec, PDO::PARAM_INT);
	$val -> execute();
	$data = $val -> fetch(PDO::FETCH_OBJ);
} catch (PDOException $e) {
	echo $e->getMessage();
} finally {
	$dbc = null;
}
?>

<div class="container-fluid animated fadeIn delya-1s mt-4">
	
	<h3 class="text-center font-weight-bold">
		Configuracion de contraseña para el emplado: <?php echo $data->nombre_adm; ?>
	</h3>

	<form class="row mt-5 mb-4" id="formPass">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<div class="form-group mb-2">
				<input type="hidden" value="<?php echo $valRec; ?>" name="id_empleado">
				<label for="passAct">
					<i class="fas fa-key mr-2 col-spin"></i>
					Introduce tu contraseña actual</label>
				<input type="password" required="" id="passAct" name="passAct" class="form-control">
			</div>
			<div class="form-group mb-2">
				<label for="newPass">
					<i class="fas fa-key mr-2 col-spin"></i>
					Nueva contraseña</label>
				<input type="password" required="" id="newPass" name="newPass" class="form-control">
			</div>
			<div class="form-group mb-2">
				<label for="passRep">
					<i class="fas fa-key mr-2 col-spin"></i>
					Repite la contraseña</label>
				<input type="password" required="" id="passRep" name="passRep" class="form-control">
			</div>
			<div class="mt-4 text-center">
				<button class="btn-md btn btn-success" type="submit" id="butnAct">
					Actualizar
				</button>
				<div class="d-none" id="mosLoad">
					<div class="spinner-border text-success" role="status" style="width: 2rem; height: 2rem;">
				  		<span class="sr-only">Loading...</span>
					</div>
					<h5 class="text-center mt-2 spacing5">
						<b>
							Actualizando...
						</b>
					</h5>
				</div>
				<div class="mt-4 d-none" id="mosGood">
					<h5 class="text-center text-success font-weight-bold">
						<i class="fas fa-check mr-2"></i>
						Contraseña actualizada
					</h5>
				</div>
			</div>
		</div>
	</form>


</div>

<script src="<?php echo SERVERURLADM; ?>js/confpassemp.js"></script>