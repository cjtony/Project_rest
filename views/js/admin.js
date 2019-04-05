document.addEventListener('DOMContentLoaded', () => {

	/*----------  ID's Fields Form  ----------*/

	const userUs = document.getElementById('userUs');
	const passUs = document.getElementById('passUs');

	/*----------  ID's Button Ini, Form  ----------*/
	
	const btnIni = document.getElementById('btnIni');
	const formDa = document.getElementById('formDa');

	/*----------  ID's divs validations  ----------*/
	
	const divErr = document.getElementById('divErr');
	const divGod = document.getElementById('divGod');
	const divCor = document.getElementById('divCor');
	const divUsr = document.getElementById('divUsr');
	

	/*----------  Send data register  ----------*/
	
	btnIni.addEventListener('click', (e) => {

		e.preventDefault( e );
		const formDat = new FormData($(formDa)[0]);
		if (userUs.value.length > 0 && passUs.value.length > 0) {	
			divGod.classList.remove('d-none');
			btnIni.disabled = true;
			setTimeout(() => {
				$.ajax({
					url : "../ajax/reglogCli.php?oper=loginadm",
					type : "POST", data : formDat,
					contentType : false, processData : false,
					success : ( resp ) => {
						if ( resp == 1 ) {
							divSus.classList.remove('d-none');
							setTimeout(() => {
								location.href = '../modadm/Home/';
							}, 4000);
						} else if ( resp == 2 ) {
							divFal.classList.remove('d-none');
							userUs.value = ""; passUs.value = "";
							setTimeout(() => {
								divFal.classList.add('d-none');
							}, 2000);
						} else if ( resp == 3 ) {
							location.reload();
						} else {
							console.log( resp );
						}
					}
				});
				divGod.classList.add('d-none'); 
				btnIni.disabled = false;
			},5000);
		} else {
			divErr.classList.remove('d-none');
			setTimeout(() => {
				divErr.classList.add('d-none');
			}, 3000);
		}

	});


});