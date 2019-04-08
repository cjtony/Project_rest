<?php 

$dbc = new Connect();
$dbc = $dbc -> getDB();
$query = $dbc -> prepare("SELECT * FROM clientes WHERE id_cliente = :keyCli");
$query -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
$query -> execute();
$dataC = $query -> fetch(PDO::FETCH_OBJ);
?>

<div class="container-fluid animated fadeIn delay-1s mt-4">
	
	<h1 class="text-center font-weight-bold">
		Cambiar datos
	</h1>

	<form class="mt-5 mb-4 row" autocomplete="off" id="formEdit">
		<div class="col-sm-4"></div>
		<div class="col-sm-4 mb-2">
			<div class="form-group">
				<label for="nameUs">Nombre:</label>
				<input type="text" class="form-control" required value="<?php echo $dataC->nombre_cli; ?>" name="nameUs" id="nameUs">
			</div>
			<div class="form-group">
				<label for="telUs">Telefono:</label>
				<input type="tel" class="form-control" required value="<?php echo $dataC->telefono_cli; ?>" name="telUs" id="telUs">
			</div>
			<div class="form-group">
				<label for="corUs">Correo:</label>
				<input type="email" class="form-control" required value="<?php echo $dataC->correo_cli; ?>" name="corUs" id="corUs">
			</div>
			<div class="form-group">
				<label for="userUs">Usuario:</label>
				<input type="text" class="form-control" required value="<?php echo $dataC->usuario_cli; ?>" name="userUs" id="userUs">
			</div>
			<div class="form-group">
				<label for="pasUs">Contraseña</label>
				<input type="password" name="pasUs" id="pasUs" class="form-control" required>
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

<script src="<?php echo SERVERURLCLI; ?>js/confdata.js"></script>