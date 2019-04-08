document.addEventListener('DOMContentLoaded', () => {

	const formPass = document.getElementById( 'formPass' );
	const butnAct = document.getElementById( 'butnAct' );
	const mosLoad = document.getElementById( 'mosLoad' );
	const mosGood = document.getElementById( 'mosGood' );

	formPass.addEventListener('submit', ( e ) => {
		e.preventDefault();
		const formDat = new FormData($(formPass)[0]);
		const newPass = document.getElementById( 'newPass' );
		const passRep = document.getElementById( 'passRep' );
		if (newPass.value == passRep.value) {
			butnAct.classList.add( 'd-none' );
			mosLoad.classList.remove( 'd-none' );
			setTimeout( () => {
				$.ajax({
					url : "../../ajax/peticcli/confData.php?oper=changepass",
					type : "POST", data : formDat,
					contentType : false, processData : false,
					success : ( resp ) => {
						if ( resp == 1 ) {
							mosGood.classList.remove( 'd-none' );
							mosLoad.classList.add( 'd-none' );
							setTimeout( () => {
								butnAct.classList.remove( 'd-none' );
								mosGood.classList.add( 'd-none' );
								formPass.reset();
							}, 2000);
						} else {
							butnAct.classList.remove( 'd-none' );
							mosLoad.classList.add( 'd-none' );
							alert( resp );
						}
					} 
				});
			}, 2000);
		} else {
			alert('Las contraseñas no coinciden');
		}

	});

});