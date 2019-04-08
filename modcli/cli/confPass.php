<div class="container-fluid animated fadeIn delya-1s mt-4 p-2 rounded shadow">
	
	<h1 class="text-center font-weight-bold">
		Configuracion de contraseña
	</h1>
	<hr>
	<form class="row mt-4 mb-4" id="formPass">
		<div class="col-sm-3"></div>
		<div class="col-sm-6 p-3">
			<div class="form-group mb-2">
				<label for="passAct">
					<i class="fas fa-key mr-2 col-spin"></i>
					Contraseña actual</label>
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

<script src="<?php echo SERVERURLCLI; ?>js/confpass.js"></script>