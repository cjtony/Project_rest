<?php 

$dbc = new Connect();
$dbc = $dbc -> getDB();
$query = $dbc -> prepare("SELECT * FROM clientes WHERE id_cliente = :keyCli");
$query -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
$query -> execute();
$dataC = $query -> fetch(PDO::FETCH_OBJ);

?>
<h1 class="text-center">Bienvenido administrador</h1>

<div class="container animated fadeIn delay-1s">
	
	<div class="row mt-5">
		<div class="col-sm-3"></div>
		<div class="col-sm-6 p-4 border border-primary shadow rounded">
			
			<h4 class="text-center font-weight-bold">
				<b class="text-danger">*</b> Información <b class="text-danger">*</b>
			</h4>
			<hr>
			<p class="text-justify">
				Estimado usuario del sistema <b><?php echo $dataAdmin->nombre_adm; ?></b> por favor de mantenerse alerta a las notificaciones para confirmar las solicitudes de pedidos.
			</p>
			<hr>
			<p class="text-justify">
				También es importante que los platillos se mantengan actualizados de manera correcta para una mejor experiencia del usuario.
			</p>
		</div>
	</div>

</div>