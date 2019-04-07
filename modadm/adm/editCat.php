<?php 

$cod = explode("/", $_GET['view']);
$valRec = $cod[1];
try {
	$dbc = new Connect();
	$dbc = $dbc -> getDB();
	$dataRec = $dbc -> prepare("SELECT * FROM categoria WHERE id_categoria = :valRec");
	$dataRec -> bindParam("valRec", $valRec, PDO::PARAM_INT);
	$dataRec -> execute();
	$data = $dataRec -> fetch(PDO::FETCH_OBJ);
} catch (PDOException $e) {
	echo $e->getMessage();
} finally {
	$dbc = null;
}
?>

<div class="container-fluid animated fadeIn delay-1s mt-4">

	<h1 class="text-center font-weight-bold">
		Editar categoria
	</h1>
	
	<form autocomplete="off" class="row mt-5 mb-4" id="formDat">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="form-group">
				<input type="hidden" value="<?php echo $data->id_categoria; ?>" name="id_categoria">
				<label for="nameCat">Nombre</label>
				<input type="text" value="<?php echo $data->nombre_cat; ?>" class="form-control" id="nameCat" name="nameCat" required>
			</div>
			<div class="form-group">
				<label for="descCat">Descripcion</label>
				<input type="text" value="<?php echo $data->descripcion_cat; ?>" class="form-control" id="descCat" name="descCat" required>
			</div>
			<div class="form-group">
				<label for="estCat">Estado</label>
				<select id="estCat" name="estCat" class="form-control">
					<?php 
						if ($data->estado_cat == 1) {
					?>
						<option value="N">Selecciona</option>
						<option value="1" selected>Habilitada</option>
						<option value="0">Inhabilitada</option>
					<?php
						} else {
					?>
						<option value="N">Selecciona</option>
						<option value="1">Habilitada</option>
						<option value="0" selected>Inhabilitada</option>
					<?php
						}
					?>
				</select>
			</div>
			<div class="mb-2 text-center mt-4">
				<button class="btn-md btn btn-success" type="submit" id="butnAct">
					Actualizar datos
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
		</div>
	</form>
</div>

<script src="<?php echo SERVERURLADM; ?>js/editcat.js"></script>