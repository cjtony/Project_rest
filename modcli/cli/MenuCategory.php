<?php 

$val = explode("/", $_GET['view']);
$valrecib = $val[1];

$dataCat = $climodel -> menuCat($valrecib);

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


</div>