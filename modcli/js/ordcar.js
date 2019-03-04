document.addEventListener('DOMContentLoaded', () => {

	const formCP = document.getElementById('formCP');
	const dirEnv = document.getElementById('dirEnv');
	const pasCon = document.getElementById('pasCon');
	const btnEnv = document.getElementById('btnEnv');

	ordcar = () => {
        $.ajax({
          	url : '../../ajax/peticcli/funccarcom.php?oper=ordcar',
          	type : "POST",
          	success : ( data ) => {
            	$('#ordcar').html(data);
          	}
        });
      }
	
	const reloadCar = setInterval(ordcar, 1000);

	btnEnv.addEventListener('click', ( e ) => {
		e.preventDefault();
		formDa = new FormData($(formCP)[0]);
		if (dirEnv.value != 0 && pasCon.value.length > 0) {
			clearInterval(reloadCar);
			$.ajax({
				url : "../../ajax/peticcli/pedidconf.php?oper=confped",
				type : "POST", data : formDa,
				contentType : false, processData : false,
				success : ( resp ) => {
					console.log( resp );
				}
			});
		} else {
			alert('mal');
		}
	});

});