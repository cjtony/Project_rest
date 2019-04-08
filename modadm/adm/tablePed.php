<?php 

$dbc = new Connect();
$dbc = $dbc -> getDB();
$valid = 1;
$countNotif = $dbc -> prepare("SELECT DISTINCTROW dp.cod_conf AS 'COD' FROM det_pedido dp");
$countNotif -> execute();

?>

<div class="container-fluid animated fadeIn delay-1s mt-4">
	
	<div class="rounded p-2">
		<h1 class="text-center mt-3 mb-3">
			<b>
				Listado de clientes
			</b>
		</h1>
		<hr>
		<div class="table-responsive bg-white rounded shadow p-2">
        	<table class="table table-bordered table-hover" id="tbListadoClients" width="100%" cellspacing="0">
          		<thead>
            		<tr>
						<th>Codigo de pedido</th>
						<th>Cliente</th>
						<th>Fecha y hora de pedido</th>
						<th>Estado</th>
						<th>Acciones</th>
            		</tr>
          		</thead>
          		<tbody>
          			<?php 
          					$dbc = new Connect();
          					$dbc = $dbc -> getDB();
          					while ( $dn = $countNotif -> fetch(PDO::FETCH_OBJ) ) {
                    			$codigo = $dn -> COD;
                    			$query = $dbc -> prepare("SELECT dp.confirm_ped, dp.fecha_hora_ped, dp.cod_conf, cl.nombre_cli FROM det_pedido dp  INNER JOIN carrito car ON car.id_carrito = dp.id_carrito INNER JOIN plat_menu pm ON pm.id_platillo = car.id_platillo INNER JOIN categoria ct ON ct.id_categoria = pm.id_categoria INNER JOIN clientes cl ON cl.id_cliente = car.id_cliente INNER JOIN direcciones dr ON dr.id_direccion = dp.id_direccion WHERE dp.cod_conf = :codigo LIMIT 1");
                    			$query -> bindParam("codigo", $codigo, PDO::PARAM_STR);
          						$query -> execute();
          						while ($dt = $query -> fetch(PDO::FETCH_OBJ)) {
          			?>
							<tr>
								<td>
									<?php echo $dt->cod_conf; ?></td>
								<td><?php echo $dt->nombre_cli; ?></td>
								<td><?php echo $dt->fecha_hora_ped; ?></td>
								<td>
									<?php 
										if ($dt->confirm_ped == 1) {
									?>
										<span class="badge badge-danger p-2">
											Sin confirmar
										</span>
									<?php
										} else {
									?>
										<span class="badge badge-success p-2">
											Confirmado
										</span>
									<?php
										}
									?>
								</td>
								<td>
									<!-- <a href="<?php echo SERVERURLADM; ?>editEmp/<?php echo $dt->id_cliente; ?>/" class="ml-2 btn btn-sm btn-success">
										Editar Contraseña
									</a> -->
									<a href="<?php echo SERVERURLADM; ?>detPed/<?php echo $dt->cod_conf; ?>/" class="ml-2 btn btn-sm btn-success">
										Detalles
									</a>
								</td>
							</tr>
          			<?php
          					}
                    ?>

                    <?php
                    		}
          			?>
          		</tbody>
          		<tfoot>
            		<tr>
            			<th>Codigo de pedido</th>
						<th>Cliente</th>
						<th>Fecha y hora de pedido</th>
						<th>Estado</th>
						<th>Acciones</th>
            		</tr>
          		</tfoot>
          		<tbody>
          		</tbody>
        	</table>
    	</div>
	</div>
</div>
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', () => {

		const lenguaje = {
		    "sProcessing":     "Procesando...",
		    "sLengthMenu":     "Mostrar _MENU_ registros",
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Ningún dato disponible en esta tabla",
		    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Buscar:",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Cargando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
		};
		
		$("#tbListadoClients").DataTable({
			"language" : lenguaje
		});

	});
</script>