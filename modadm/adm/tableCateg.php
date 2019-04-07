
<div class="container-fluid animated fadeIn delay-1s mt-4">
	
	<div class="rounded p-2">
		<h1 class="text-center mt-3 mb-3">
			<b>
				Listado de categorias
			</b>
		</h1>
		<hr>
		<div class="table-responsive bg-white rounded shadow p-2">
        	<table class="table table-bordered table-hover" id="tbListadoClients" width="100%" cellspacing="0">
          		<thead>
            		<tr>
						<th>Nombre:</th>
						<th>Descripcion:</th>
						<th>Estado:</th>
						<th>Acciones:</th>
            		</tr>
          		</thead>
          		<tbody>
          			<?php
          				try {
          					$dbc = new Connect();
          					$dbc = $dbc -> getDB();
          					$query = $dbc -> prepare("SELECT * FROM categoria");
          					$query -> execute();
          					while ($dt = $query -> fetch(PDO::FETCH_OBJ)) {
          			?>
							<tr>
								<td>
									<?php echo $dt->nombre_cat; ?></td>
								<td><?php echo $dt->descripcion_cat; ?></td>
								<td>
									<?php 
										if ($dt->estado_cat == 1) {
									?>
										<span class="badge badge-success p-2">
											Habilitada
										</span>
									<?php
										} else {
									?>
										<span class="badge badge-danger p-2">
											Inhabilitada
										</span>
									<?php
										}
									?>
								</td>
								<td>
									<a href="<?php echo SERVERURLADM; ?>editCat/<?php echo $dt->id_categoria; ?>/" class="ml-2 btn btn-sm btn-success">
										Editar
									</a>
								</td>
							</tr>
          			<?php
          					}
          				} catch (PDOException $e) {
          					echo $e->getMessage();
          				} finally {
          					$dbc = null;
          				}
          			?>
          		</tbody>
          		<tfoot>
            		<tr>
             			<th>Nombre:</th>
						<th>Descripcion:</th>
						<th>Estado:</th>
						<th>Acciones:</th>
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