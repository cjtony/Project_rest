<div class="container-fluid animated fadeIn delay-1s mt-4">
	
	<h1 class="text-center font-weight-bold">
		Registrar categoría
	</h1>

	<form id="formDat" class="row mt-5 mb-4" autocomplete="off">
		
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="nameCat">Nombre</label>
				<input type="text" class="form-control" id="nameCat" name="nameCat" required>
			</div>
			<div class="form-group">
				<label for="descCat">Descripcion</label>
				<input type="text" class="form-control" id="descCat" name="descCat" required>
			</div>
			<div class="form-group mt-4">
				<hr> 
				<h5 class="text-center text-danger font-weight-bold m-0 p-0">Información</h5>
				<p class="text-info mt-3">
					Al registrar una categoria en automaticamente se registra como activa.
				</p>
				<hr>
			</div>
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

<script src="<?php echo SERVERURLADM; ?>js/regcateg.js"></script>