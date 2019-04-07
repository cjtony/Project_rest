document.addEventListener('DOMContentLoaded', () => {

	const formDat = document.getElementById('formDat');
	const butnAct = document.getElementById( 'butnAct' );
	const mosLoad = document.getElementById( 'mosLoad' );
	const mosGood = document.getElementById( 'mosGood' );

	formDat.addEventListener('submit', ( e ) => {
		e.preventDefault();
		const formData = new FormData($(formDat)[0]);
		const select = document.getElementById('selCat');
		const imgPla = document.getElementById('imgPla').value;
		const extPerm0 = /(.jpg)$/i;
		const extPerm1 = /(.jpeg)$/i;
		const extPerm2 = /(.png)$/i;
		if (selCat.value != 0) {
			if (imgPla.length > 0) {
				if (!extPerm0.exec(imgPla) && !extPerm1.exec(imgPla) && !extPerm2.exec(imgPla)) {
					alert('Selecciona una imagen .jpeg, .jpg, .png');
					$("#imgPla").val("");
				} else {
					butnAct.classList.add( 'd-none' );
					mosLoad.classList.remove( 'd-none' );
					setTimeout( () => {
						$.ajax({
							url : "../../ajax/peticadm/platillo.php?oper=regplat",
							type : "POST", data : formData,
							contentType : false, processData : false,
							success : ( resp ) => {
								if ( resp == 1 ) {
									mosGood.classList.remove( 'd-none' );
									mosLoad.classList.add( 'd-none' );
									setTimeout( () => {
										butnAct.classList.remove( 'd-none' );
										mosGood.classList.add( 'd-none' );
										formDat.reset();
									}, 2000);
								} else {
									butnAct.classList.remove( 'd-none' );
									mosLoad.classList.add( 'd-none' );
									alert( resp );
								}
							} 
						});
					}, 2000);
				}
			} else {
				alert('Introduce una imagen');
			}
		} else {
			alert('Selecciona una categoria')
		}
	});
});