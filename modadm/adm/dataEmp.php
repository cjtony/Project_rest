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
		Datos del empleado: <?php echo $data->nombre_adm; ?>
	</h3>
	
	<div class="container rounded shadow p-2 mt-5">
		
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-4 mb-4">
				<div class="mt-3">
					<b>Correo:</b>
					<p>
						<i class="fas fa-envelope mr-2"></i>
						<?php echo $data->correo_adm; ?>
					</p>
				</div>
				<div class="mt-3">
					<b>Usuario:</b>
					<p>
						<i class="fas fa-user mr-2"></i>
						<?php echo $data->usuario_adm; ?>
					</p>
				</div>
				<div class="mt-3">
					<b>Fecha de registro:</b>
					<p>
						<i class="fas fa-calendar mr-2"></i>
						<?php echo formatFech($data->fecha_reg); ?>
					</p>
				</div>
				<div class="mt-3">
					<b>Ultimo inicio de sesión:</b>
					<p>
						<i class="fas fa-calendar mr-2"></i>
						<?php 
							if ($data->fech_activ != Null) {
						?>
							<?php echo formatFech($data->fech_activ); ?>
						<?php	
							} else {
						?>
							Nunca ha iniciado sesión.
						<?php
							}
						?>
					</p>
				</div>
				<div class="mt-3">
					<b>Cuenta:</b>
					<?php 
						if ($data->est_cuenta_adm == 1) {
					?>
						<span class="badge badge-success p-2 ml-3">
							<i class="fas fa-check mr-2"></i>
							Activa
						</span>
					<?php	
						} else {
					?>
						<span class="badge badge-danger p-2 ml-3">
							<i class="fas fa-times mr-2"></i>
							Inactiva
						</span>
					<?php
						}
					?>
				</div>
			</div>
			<div class="col-sm-4 mt-5 text-center">
				<div class="mt-5">
					<?php 
						if ($data->est_cuenta_adm == 1) {
					?>
						<p class="font-weight-bold">
							Al desactivar una cuenta el usuario no podra ingresar al sistema.
						</p>
						<hr>
						<button class="btn btn-danger btn-sm" onclick="desEmp(<?php echo $data->id_admin; ?>)">
							<i class="fas fa-check mr-2"></i>
							Desactivar cuenta
						</button>
					<?php	
						} else {
					?>
						<p class="font-weight-bold">
							Al activar una cuenta el usuario podra ingresar al sistema.
						</p>
						<hr>
						<button class="btn btn-success btn-sm" onclick="actEmp(<?php echo $data->id_admin; ?>)">
							<i class="fas fa-check mr-2"></i>
							Activar cuenta
						</button>
					<?php
						}
					?>
				</div>
			</div>
		</div>

	</div>

</div>

<script src="<?php echo SERVERURLADM; ?>js/actdesemp.js"></script>