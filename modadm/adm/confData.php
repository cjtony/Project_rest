<div class="container-fluid animated fadeIn delay-1s mt-4">
	
	<h1 class="text-center font-weight-bold">
		Cambiar datos
	</h1>

	<form class="mt-5 mb-4 row" autocomplete="off" id="formEdit">
		<div class="col-sm-4"></div>
		<div class="col-sm-4 mb-2">
			<div class="form-group">
				<label for="nameUs">Nombre:</label>
				<input type="text" class="form-control" required value="<?php echo $dataAdmin->nombre_adm; ?>" name="nameUs" id="nameUs">
			</div>
			<div class="form-group">
				<label for="corUs">Correo:</label>
				<input type="email" class="form-control" required value="<?php echo $dataAdmin->correo_adm; ?>" name="corUs" id="corUs">
			</div>
			<div class="form-group">
				<label for="userUs">Usuario:</label>
				<input type="text" class="form-control" required value="<?php echo $dataAdmin->usuario_adm; ?>" name="userUs" id="userUs">
			</div>
			<div class="form-group">
				<label for="pasUs">Introduce tu contraseña para continuar:</label>
				<input type="password" class="form-control" required name="pasUs" id="pasUs">
			</div>
		</div>
		<div class="col-sm-4"></div>
		<div class="col-sm-4"></div>
		<div class="col-sm-4 mb-2 text-center mt-4">
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

<script src="<?php echo SERVERURLADM; ?>js/confdata.js"></script>