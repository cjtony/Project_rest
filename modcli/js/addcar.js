document.addEventListener('DOMContentLoaded', () => {

	const formCar = document.getElementById('formCar');
	const addCarr = document.getElementById('addCarr');
	const carradd = document.getElementById('carradd');

	carordern = () => {
        $.ajax({
          	url : '<?php echo SERVERURL; ?>ajax/peticcli/funccarcom.php?oper=mostord',
          	type : "POST",
          	success : ( data ) => {
            	$('#mostord').html(data);
          	}
        });
      }

	carprecie = () => {
        $.ajax({
          	url : './../../../ajax/peticcli/funccarcom.php?oper=mostpre',
          	type : "POST",
          	success : ( data ) => {
            	$('#mostpre').html(data);
          	}
        });
    }

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
				carprecie();
				carordern();
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
					carprecie();
					carordern();
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
	carprecie();
	carordern();

});