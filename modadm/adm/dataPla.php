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
	
	<h3 class="text-center font-weight-bold">
		Datos del platillo: <b><?php echo $data->nombre_plat; ?></b>
	</h3>
	<hr>
	<div class="container p-2 border border-success rounded shadow">
		<div class="row">
			
			<div class="col-sm-6 mb-4 mt-4">
				<div class="ml-4">
					<b>Descripcion:</b>
					<p>
						<i class="fas fa-comment mr-2"></i>
						<?php echo $data->descripcion_plat; ?></p>
				</div>
				<div class="ml-4">
					<b>Precio:</b>
					<p>
						<i class="fas fa-dollar-sign mr-2"></i>
						<?php echo $data->precio_plat; ?></p>
				</div>
				<div class="ml-4">
					<b>Tiempo de preparación:</b>
					<p>
						<i class="fas fa-clock mr-2"></i>
						<?php echo $data->tiempo_prepare; ?></p>
				</div>
				<div class="ml-4">
					<b>Estado:</b>
					<?php 
						if ($data->estado_plat == 1) {
					?>
						<span class="badge badge-success p-2 ml-3">
							<i class="fas fa-check mr-2"></i>
							Activo
						</span>
					<?php	
						} else {
					?>
						<span class="badge badge-danger p-2 ml-3">
							<i class="fas fa-times mr-2"></i>
							Inactivo
						</span>
					<?php
						}
					?>
				</div>
			</div>
			<div class="col-sm-6 mb-4 text-center">
				<div class="text-center mt-4">
					<img src="<?php echo SERVERURL; ?>files/platillos/<?php echo $data->imagen_plat1; ?>" class="rounded shadow">
				</div>
			</div>

		</div>
	</div>

	

</div>