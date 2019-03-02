<?php 

$val = explode("/", $_GET['view']);
$valrec = $val[1];
$valcat = $val[2];

$datPla = $climodel -> detailsPlat($valrec);

?>

<div class="container-fluid animated fadeIn delay-1s mt-4">
	
	<div class="row mt-5">
		<div class="col-sm-4 shadow p-3 rounded">
			<h3 class="text-center">
				<?php echo $datPla->nombre_plat; ?>
			</h3>
			<hr>
			<div class="text-center">
				<img src="<?php echo SERVERURL; ?>fotmenu/<?php echo $datPla->imagen_plat1; ?>" class="rounded img-fluid" width="400" alt="<?php echo $datPla->nombre_plat; ?>">
			</div>
			<h5 class="text-primary text-center mt-4">
				Categoria:
				<a href="<?php echo SERVERURLCLI; ?>MenuCategory/<?php echo $valcat; ?>/">
					<span class="badge badge-primary"><?php echo $datPla->nombre_cat; ?></span>
				</a>
			</h5>
		</div>
		<div class="col-sm-1"></div>
		<div class="col-sm-7 mt-5">
			<div>
				<h4 class="font-weight-bold">Descripcion:</h4>
				<p class="lead p-3">
					<?php echo $datPla->descripcion_plat; ?>
				</p>
				<h4 class="font-weight-bold">Tiempo de preparación:</h4>
				<p class="lead p-3">
					<?php echo $datPla->tiempo_prepare; ?>
				</p>
				<h4 class="font-weight-bold">Precio:
					<span class="badge-primary badge ml-3">$ <?php echo $datPla->precio_plat; ?>.</span>
				</h4>
			</div>
			<hr>
			<div class="row mt-5">
				<form id="formCar">
					<input type="hidden" value="<?php echo $valrec; ?>" name="clv_plat">
				</form>
				<div class="col-sm-6 text-center">
					<button class="btn btn-outline-primary" id="addCarr">
						Agregar al carrito
					</button>
					<div class="text-center mt-4 d-none" id="carradd">
						<span class="text-success"><i class="fas fa-check mr-2"></i>Agregado al carrito</span>
					</div>
				</div>
				<div class="col-sm-6 text-center">
					<button class="btn btn-outline-primary">
						Comprar!
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo SERVERURLCLI; ?>js/addcar.js"></script>