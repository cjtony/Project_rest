document.addEventListener('DOMContentLoaded', () => {

	const formDat = document.getElementById('formDat');
	const butnAct = document.getElementById( 'butnAct' );
	const mosLoad = document.getElementById( 'mosLoad' );
	const mosGood = document.getElementById( 'mosGood' );

	formDat.addEventListener('submit', ( e ) => {
		e.preventDefault();
		const formData = new FormData($(formDat)[0]);
		const estCat = document.getElementById('estCat');
		if (estCat.value != "N") {
			butnAct.classList.add( 'd-none' );
			mosLoad.classList.remove( 'd-none' );
			setTimeout( () => {
				$.ajax({
					url : "../../../ajax/peticadm/categoria.php?oper=editcat",
					type : "POST", data : formData,
					contentType : false, processData : false,
					success : ( resp ) => {
						if ( resp == 1 ) {
							mosGood.classList.remove( 'd-none' );
							mosLoad.classList.add( 'd-none' );
							setTimeout( () => {
								butnAct.classList.remove( 'd-none' );
								mosGood.classList.add( 'd-none' );
								setTimeout(()=> {
									location.reload();
								}, 500);
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
			alert('Selecciona un estado');
		}
	});

});