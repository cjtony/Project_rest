<?php 

$cod = explode("/", $_GET['view']);
$valRec = $cod[1];
try {
	$dbc = new Connect();
	$dbc = $dbc -> getDB();
	$dataRec = $dbc -> prepare("SELECT * FROM plat_menu pm INNER JOIN categoria ct ON ct.id_categoria = pm.id_categoria WHERE id_platillo = :valRec");
	$dataRec -> bindParam("valRec", $valRec, PDO::PARAM_INT);
	$dataRec -> execute();
	$data = $dataRec -> fetch(PDO::FETCH_OBJ);
} catch (PDOException $e) {
	echo $e->getMessage();
} finally {
	$dbc = null;
}
?>

<div class="container-fluid animated fadeIn delay-1s">
	
	<h1 class="text-center font-weight-bold">
		Editar platillo
	</h1>

	<form class="row mb-4 mt-5" id="formDat" autocomplete="off">
		
		<div class="col-sm-6">
			<div class="form-group">
				<input type="hidden" value="<?php echo $data->id_platillo; ?>" name="id_platillo">
				<label for="selCat">Nueva categoria</label>
				<select class="form-control" name="selCat" id="selCat">
					<option value="0" selected>Categoria</option>
					<?php 
						try {
							$dbc = new Connect();
							$dbc = $dbc -> getDB();
							$valid = 1;
							$selectCat = $dbc -> prepare("SELECT * FROM categoria WHERE estado_cat = :valid");
							$selectCat -> bindParam("valid", $valid, PDO::PARAM_INT);
							$selectCat -> execute();
							while ($dat = $selectCat -> fetch(PDO::FETCH_OBJ)) {
								if ($dat->id_categoria == $data->id_categoria) {
									echo "<option selected value='".$dat->id_categoria."'>".$dat->nombre_cat."</option>";
								} else {
									echo "<option value='".$dat->id_categoria."'>".$dat->nombre_cat."</option>";
								}
							}
						} catch (PDOException $e) {
							echo $e->getMessage();
						} finally {
							$dbc = null;
						}
					?>
				</select>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="namePla">Nombre del platillo</label>
				<input type="text" value="<?php echo $data->nombre_plat; ?>" id="namePla" name="namePla" class="form-control" required>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label for="descPla">Descripcion del platillo</label>
				<input type="text" value="<?php echo $data->descripcion_plat; ?>" id="descPla" name="descPla" class="form-control" required>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label for="prePla">Precio del platillo</label>
				<input type="number" value="<?php echo $data->precio_plat; ?>" id="prePla" name="prePla" class="form-control" required>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label for="timePla">Tiempo de preparacion del platillo</label>
				<input type="text" value="<?php echo $data->tiempo_prepare; ?>" id="timePla" name="timePla" class="form-control" required>
			</div>
		</div>
		<div class="col-sm-6 text-center mt-4">
			<div class="form-group">
				<label>Imagen actual</label>
				<br>
				<img src="<?php echo SERVERURL; ?>files/platillos/<?php echo $data->imagen_plat1; ?>" width="200" class="rounded shadow" alt="">
			</div>
		</div>
		<div class="col-sm-6 text-center mt-5">
			<label class="mt-4" for="imgPla">Imagen del platillo</label>
			<input type="file" id="imgPla" name="imgPla" class="form-control-file mt-4">
		</div>
		<div class="col-sm-4"></div>
		<div class="col-sm-4 mt-3">
			<div class="form-group">
				<label for="estCat">Estado</label>
				<select id="estCat" name="estCat" class="form-control">
					<?php 
						if ($data->estado_plat == 1) {
					?>
						<option value="N">Selecciona</option>
						<option value="1" selected>Habilitado</option>
						<option value="0">Inhabilitado</option>
					<?php
						} else {
					?>
						<option value="N">Selecciona</option>
						<option value="1">Habilitado</option>
						<option value="0" selected>Inhabilitado</option>
					<?php
						}
					?>
				</select>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="col-sm-12 mt-4">
				<div class="mb-2 text-center mt-4">
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
			</div>
		</div>
	</form>
</div>
<script src="<?php echo SERVERURLADM; ?>js/editplat.js"></script>