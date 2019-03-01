<?php 

$datCat = $climodel -> catDetails();

?>

<div class="container-fluid mt-4 animated fadeIn delay-1s">
	
	<h1 class="text-center font-weight-bold mt-5">
		Selecciona una de nuestras categorías <i class="fas fa-book-open ml-2"></i>
	</h1>
	<p class="lead text-center mt-4">
		Despues elige el platillo que sea mas de tu agrado...
	</p>
	<br><br>
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