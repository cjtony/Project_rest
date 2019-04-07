document.addEventListener('DOMContentLoaded', () => {

	actEmp = ( clvEmp ) => {
		$.post("../../../ajax/peticadm/confDatPas.php?oper=actEmp", {clvEmp : clvEmp}, ( resp ) => {
			if ( resp == 1 ) {
				alert( "Empleado Activado" );
				location.reload();
			} else {
				alert( resp )
			}
		});
	}

	desEmp = ( clvEmp ) => {
		$.post("../../../ajax/peticadm/confDatPas.php?oper=desEmp", {clvEmp : clvEmp}, ( resp ) => {
			if ( resp == 1 ) {
				alert( "Empleado Desactivado" );
				location.reload();
			} else {
				alert( resp )
			}
		});
	}


});