<div class="container-fluid animated fadeIn delay-1s mt-4">
	
	<h1 class="text-center font-weight-bold">
		Registrar platillo
	</h1>

	<form id="formDat" autocomplete="off" class="row mt-5 mb-4">
		
		<div class="col-sm-6">
			<div class="form-group">
				<label for="selCat">Selecciona la categoria</label>
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
								echo "<option value='".$dat->id_categoria."'>".$dat->nombre_cat."</option>";
							}
						} catch (PDOException $e) {
							echo $e->getMessage();
						} finally {
							$dbc = null;
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="descPla">Descripcion del platillo</label>
				<input type="text" id="descPla" name="descPla" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="timePla">Tiempo de preparacion del platillo</label>
				<input type="text" id="timePla" name="timePla" class="form-control" required>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="namePla">Nombre del platillo</label>
				<input type="text" id="namePla" name="namePla" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="prePla">Precio del platillo</label>
				<input type="number" id="prePla" name="prePla" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="imgPla">Imagen del platillo</label>
				<input type="file" id="imgPla" name="imgPla" class="form-control-file" required>
			</div>
		</div>
		<div class="col-sm-12 mt-4">
			<div class="mb-2 text-center mt-4">
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
		</div>
	</form>
</div>

<script src="<?php echo SERVERURLADM; ?>js/regplat.js"></script>