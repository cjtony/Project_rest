<?php 

$val = explode("/", $_GET['view']);
$valrecib = $val[1];

$dataCat = $climodel -> menuCat($valrecib);
$dataPla = $climodel -> plaMenu($valrecib);

?>

<div class="container-fluid mt-4 animated fadeIn delay-1s">
	
	<div class="jumbotron jumbotron-fluid rounded shadow">

		<div class="container text-center">
			<h1 class="display-4">
				<?php echo $dataCat -> nombre_cat; ?>
			</h1>
			<p class="lead">Selecciona uno de los platillos de esta categoria, nosotros te lo llevamos a tu domicilio.</p>
		</div>
		
	</div>

	<div class="row">

		<?php 
			if ($dataPla -> rowCount() > 0) {
				while ($dat = $dataPla -> fetch(PDO::FETCH_OBJ)) {
		?>
			
			<div class="col-sm-3 mt-4 mb-4">
				<div class="card p-3">
				  	<img src="<?php echo SERVERURL; ?>files/platillos/<?php echo $dat->imagen_plat1; ?>" class="card-img-top rounded shadow" alt="hamburguesa">
				  	<div class="card-body text-center">
				    	<h5 class="card-title"><?php echo $dat -> nombre_plat; ?></h5>
				    	<hr>
				    	<p class="card-text text-justify">
				    		<?php echo $dat -> descripcion_plat; ?>
				    	</p>
				    	<a href="<?php echo SERVERURLCLI; ?>DetPlat/<?php echo $dat->id_platillo; ?>/<?php echo $valrecib; ?>/" class="btn btn-primary text-white">Ver detalles!</a>
				  	</div>
				</div>
			</div>

		<?php
				}
			} else {
		?>
			<div class="col-sm-12 mt-5">
				<h2 class="text-center text-danger">
					Aún no hay platillos registrados en esta categoria del menu...
				</h2>
				<div class="text-center">
					<i class="fas fa-times fa-2x text-danger"></i>
				</div>
			</div>
		<?php
			}
		?>

	</div>


</div>