document.addEventListener('DOMContentLoaded', () => {

	actEmp = ( clvCli ) => {
		$.post("../../../ajax/peticadm/clientes.php?oper=actEmp", {clvCli : clvCli}, ( resp ) => {
			if ( resp == 1 ) {
				alert( "Cliente Activado" );
				location.reload();
			} else {
				alert( resp )
			}
		});
	}

	desEmp = ( clvCli ) => {
		$.post("../../../ajax/peticadm/clientes.php?oper=desEmp", {clvCli : clvCli}, ( resp ) => {
			if ( resp == 1 ) {
				alert( "Cliente Desactivado" );
				location.reload();
			} else {
				alert( resp )
			}
		});
	}


});