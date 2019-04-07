<div class="container-fluid animated fadeIn delay-1s mt-4">
	
	<h1 class="text-center font-weight-bold">
		Registro de empleados
	</h1>

	<form autocomplete="off" class="row mt-5 mb-4" id="formDat">
		
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			
			<div class="form-group">
				<label for="nameUs">Nombre:</label>
				<input type="text" class="form-control" required name="nameUs" id="nameUs">
			</div>
			<div class="form-group">
				<label for="corUs">Correo:</label>
				<input type="email" class="form-control" required name="corUs" id="corUs">
			</div>
			<div class="form-group">
				<label for="userUs">Usuario:</label>
				<input type="text" class="form-control" required name="userUs" id="userUs">
			</div>
			<div class="form-group">
				<label for="pasUs">Contraseña:</label>
				<input type="password" class="form-control" required name="pasUs" id="pasUs">
			</div>
			<div class="form-group">
				<label for="repPas">Repetir contraseña:</label>
				<input type="password" class="form-control" required name="repPas" id="repPas">
			</div>

		</div>
		<div class="col-sm-3"></div>
		<div class="col-sm-12 mb-2 text-center mt-4">
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
<script src="<?php echo SERVERURLADM; ?>js/regemp.js"></script>
