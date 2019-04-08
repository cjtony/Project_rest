<?php 

$datCat = $climodel -> catDetails();
$datPla = $climodel -> menuPri();

?>

<div class="container-fluid animated fadeIn delay-1s mt-4">
	
	<div class="jumbotron jumbotron-fluid rounded shadow">

		<div class="container text-center">
			<h1 class="display-4">
				¿Estas listo para ordenar?
			</h1>
			<p class="lead">Selecciona uno de nuestros platillos, nosotros te lo llevamos a tu domicilio.</p>
		</div>
		
	</div>

	<div class="row mt-5">
		<?php 
			while ($dat = $datPla -> fetch(PDO::FETCH_OBJ)) {
		?>
			<div class="col-sm-3 mt-3 mb-3">
				<div class="card p-3">
				  	<img src="<?php echo SERVERURL; ?>files/platillos/<?php echo $dat->imagen_plat1; ?>" class="card-img-top rounded shadow" alt="hamburguesa">
				  	<div class="card-body text-center">
				    	<h5 class="card-title"><?php echo $dat->nombre_plat; ?></h5>
				    	<hr>
				    	<p class="card-text text-justify">
				    		<?php echo $dat->descripcion_plat; ?>
				    	</p>
				    	<a href="<?php echo SERVERURLCLI; ?>DetPlat/<?php echo $dat->id_platillo; ?>/<?php echo $dat->id_categoria; ?>/" class="btn btn-primary text-white">Mas detalles</a>
				  	</div>
				</div>
			</div>
		<?php
			}
		?>
	</div>

	<h2 class="text-center mt-5 font-weight-bold col-let">
		¿ Buscas más opciones ?
	</h2>
	<p class="text-center lead">
		Aquí te dejamos las categorias de nuestro menú...
	</p>

	<div class="container mt-5">
		<div class="row text-center">
			<?php 
				if ($datCat -> rowCount() > 0) {
			?>
				<?php 
					while ($dat = $datCat->fetch(PDO::FETCH_OBJ)) {
				?>
					<div class="col-sm-4 mb-4">
						<h5>
							<a href="#" class="font-weight-bold text-dark">
								<?php echo $dat -> nombre_cat; ?>
							</a>
							<div style="height: 3px; background-color: #527908; margin-top: 0.4em; border-radius: 20px;"></div>
							<p class="mt-4 text-justify">
								<?php echo $dat -> descripcion_cat; ?>
							</p>
							<div class="text-right mt-4">
								<a href="<?php echo SERVERURLCLI; ?>MenuCategory/<?php echo $dat->id_categoria; ?>/">
									Ir...
									<i class="fas fa-arrow-right"></i>
								</a>
							</div>
						</h5>
					</div>
				<?php
					}
				?>
			<?php		
				} else {
			?>
				<div class="col-sm-12">
					<h1 class="text-danger text-center">No existe ninguna categoria registrada</h1>
					<br>
					<div class="text-center">
						<i class="fas fa-times fa-3x text-danger"></i>
					</div>
					<br><br>
				</div>
			<?php
				}
			?>
		</div>
	</div>
</div>

