document.addEventListener('DOMContentLoaded', () => {

	const formCP = document.getElementById('formCP');
	const dirEnv = document.getElementById('dirEnv');
	const pasCon = document.getElementById('pasCon');
	const btnEnv = document.getElementById('btnEnv');

	const divSus = document.getElementById('divSus');
	const divFal = document.getElementById('divFal');
	const divPas = document.getElementById('divPas');
	const divErr = document.getElementById('divErr');

	ordcar = () => {
        $.ajax({
          	url : '../../ajax/peticcli/funccarcom.php?oper=ordcar',
          	type : "POST",
          	success : ( data ) => {
            	$('#ordcar').html(data);
          	}
        });
      }
	
	let reloadCar = setInterval(ordcar, 1000);

	btnEnv.addEventListener('click', ( e ) => {
		e.preventDefault();
		formDa = new FormData($(formCP)[0]);
		if (dirEnv.value != 0 && pasCon.value.length > 0) {
			clearInterval(reloadCar);
			btnEnv.disabled = true;
			$.ajax({
				url : "../../ajax/peticcli/pedidconf.php?oper=confped",
				type : "POST", data : formDa,
				contentType : false, processData : false,
				success : ( resp ) => {
					if (resp == "") {
						divFal.classList.remove('d-none');
						setTimeout( () => {
							divFal.classList.add('d-none');
						}, 3000);
						btnEnv.disabled = false;
						let reloadCar = setInterval(ordcar, 1000);
					} else if (resp == 0) {
						location.href = '../Home/';
					} else if (resp == 2) {
						divPas.classList.remove('d-none');
						setTimeout( () => {
							divPas.classList.add('d-none');
						}, 3000);
						btnEnv.disabled = false;
						let reloadCar = setInterval(ordcar, 1000);
					} else if (resp != "") {
						divSus.classList.remove('d-none');
						setTimeout( () => {
							location.href = '../MyOrders/';
						}, 4000);
					} else {
						console.log(resp);
					}
				}
			});
		} else {
			divErr.classList.remove('d-none');
			setTimeout( () => {
				divErr.classList.add('d-none');
			}, 3000);
		}
	});

});