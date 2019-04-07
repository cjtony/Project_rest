document.addEventListener('DOMContentLoaded', () => {

	confirm = ( cod ) => {
		$.post("../../../ajax/peticadm/pedido.php?oper=confirm", {cod : cod}, ( resp ) => {
			if ( resp == 1 ) {
				alert( "Pedido Confirmado" );
				location.reload();
			} else {
				alert( resp )
			}
		});
	}

});