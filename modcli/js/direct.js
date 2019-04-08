document.addEventListener('DOMContentLoaded', () => {

	const formEdit = document.getElementById( 'formDat' );
	const butnAct = document.getElementById( 'butnAct' );
	const mosLoad = document.getElementById( 'mosLoad' );
	const mosGood = document.getElementById( 'mosGood' );

	formEdit.addEventListener('submit', ( e ) => {
		e.preventDefault();
		const formDat = new FormData($(formEdit)[0]);
		butnAct.classList.add( 'd-none' );
		mosLoad.classList.remove( 'd-none' );
		setTimeout( () => {
			$.ajax({
				url : "../../ajax/peticcli/confData.php?oper=direct",
				type : "POST", data : formDat,
				contentType : false, processData : false,
				success : ( resp ) => {
					if ( resp == 1 ) {
						mosGood.classList.remove( 'd-none' );
						mosLoad.classList.add( 'd-none' );
						setTimeout( () => {
							butnAct.classList.remove( 'd-none' );
							mosGood.classList.add( 'd-none' );
							setTimeout( () => {
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
		}, 5000);
	});

});