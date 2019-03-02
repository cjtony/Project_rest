document.addEventListener('DOMContentLoaded', () => {

	const formCar = document.getElementById('formCar');
	const addCarr = document.getElementById('addCarr');
	const carradd = document.getElementById('carradd');

	carcarrit = () => {
		$.ajax({
			url : '../../../../ajax/peticcli/funccarcom.php?oper=mostcar',
			type : "POST",
			success : ( data ) => {
				$('#listcar').html(data);
			}
		});
	}

	cancarrit = () => {
		$.ajax({
			url : '../../../../ajax/peticcli/funccarcom.php?oper=cantcar',
			type : "POST",
			success : ( data ) => {
				$('#cantcar').text(data);
			}
		});
	}

	elimcar = ( param ) => {
		$.post("../../../../ajax/peticcli/funccarcom.php?oper=elimcar",
			{param : param},
			( resp ) => {
				carcarrit();
				cancarrit();
			});
	}

	addCarr.addEventListener('click', ( e ) => {
		e.preventDefault();
		const formDa = new FormData($(formCar)[0]);
		$.ajax({
			url : "../../../../ajax/peticcli/funccarcom.php?oper=addcar",
			type : "POST", data : formDa,
			contentType : false, processData : false,
			success : ( resp ) => {
				if (resp == 1) {
					carradd.classList.remove('d-none');
					setTimeout(() => {
						carradd.classList.add('d-none');
					}, 1500);
					carcarrit();
					cancarrit();
				} else if (resp == 0) {
					location.reload()
				} else {
					console.log(resp);
				}
			}
		});
	});

	carcarrit();
	cancarrit();



});