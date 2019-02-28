document.addEventListener('DOMContentLoaded', () => {

	/*----------  ID's Fields Form  ----------*/

	const nameUs = document.getElementById('nameUs');
	const teleUs = document.getElementById('teleUs');
	const mailUs = document.getElementById('mailUs');
	const userUs = document.getElementById('userUs');
	const passUs = document.getElementById('passUs');
	const repPas = document.getElementById('repPas');

	/*----------  ID's Button Reg, Form  ----------*/
	
	const btnReg = document.getElementById('btnReg');
	const formDa = document.getElementById('formDa');

	/*----------  ID's divs validations  ----------*/
	
	const divErr = document.getElementById('divErr');
	const divGod = document.getElementById('divGod');
	const divCor = document.getElementById('divCor');
	const divUsr = document.getElementById('divUsr');
	const divFal = document.getElementById('divFal');
	const divSus = document.getElementById('divSus');

	/*----------  Function validation email  ----------*/

	validEmail = () => {

		const textcorr = document.getElementById('textcorr');
		const emailValid = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

		if (emailValid.test(mailUs.value)) {
			textcorr.classList.remove('ocult');
			textcorr.textContent = 'Formato correcto!';
			textcorr.classList.add('valid-feedback','animated','fadeIn');
			textcorr.classList.remove('invalid-feedback');
			mailUs.classList.add('is-valid');
			setTimeout(function() {
				mailUs.classList.remove('is-valid');
			}, 2000);
			mailUs.classList.remove('is-invalid');
			btnReg.disabled = false;
		} else {
			textcorr.classList.remove('ocult');
			textcorr.textContent = 'Formato de correo invalido';
			textcorr.classList.add('invalid-feedback','animated','fadeIn');
			mailUs.classList.add('is-invalid');
			btnReg.disabled = true;
		}
		if (mailUs.value.length == 0) {
			textcorr.textContent = '';
			textcorr.className = 'text-center ocult';
			mailUs.className = 'form-control';
			btnReg.disabled = true;
		}

	}

	/*----------  Listener validation email  ----------*/
	
	mailUs.addEventListener('keyup', validEmail);

	/*----------  Function security password  ----------*/

	segCont = () => {

		const message = document.getElementById('message');
		const mayus = new RegExp("^(?=.*[A-Z])");
		const lower = new RegExp("^(?=.*[a-z])");
		const len = new RegExp("^(?=.{8,})");
		const numbers = new RegExp("^(?=.*[0-9])");

		if (mayus.test(passUs.value) && lower.test(passUs.value) && numbers.test(passUs.value) && len.test(passUs.value)) {
			message.innerHTML = 'Seguridad Alta <i class="fas fa-check-circle ml-2"></i>';
			message.classList.remove('ocult','text-danger','text-warning');
			message.classList.add('text-success', 'animated', 'fadeIn');
		} else if (mayus.test(passUs.value) && numbers.test(passUs.value) && len.test(passUs.value) 
			|| lower.test(passUs.value) && numbers.test(passUs.value) && len.test(passUs.value)) {
			message.innerHTML = 'Seguridad Media <i class="fas fa-exclamation-circle ml-2"></i>';
			message.classList.remove('ocult','text-success','text-danger');
			message.classList.add('text-warning', 'animated', 'fadeIn');
		} else if (mayus.test(passUs.value) && len.test(passUs.value) || lower.test(passUs.value) && len.test(passUs.value) 
			|| numbers.test(passUs.value) && len.test(passUs.value)
			|| numbers.test(passUs.value)
			|| mayus.test(passUs.value)
			|| lower.test(passUs.value)) {
			message.innerHTML = 'Seguridad Baja <i class="fas fa-times ml-2"></i>';
			message.classList.remove('ocult','text-success','text-warning');
			message.classList.add('text-danger', 'animated', 'fadeIn');
		} else {
			message.textContent = '';
			message.className = 'ocult mt-3';
		}

	}

	/*----------  Listener security password  ----------*/
	
	passUs.addEventListener('keyup', segCont);

	/*----------  Function password = reppassword  ----------*/
	
	contIgul = () => {

		const message2 = document.getElementById('message2');

		if (repPas.value.length > 0) {
			if (passUs.value === repPas.value) {
				message2.innerHTML = 'Las contraseñas coinciden <i class="fas fa-check-circle ml-2"></i>';
				message2.classList.remove('ocult','text-danger');
				message2.classList.add('text-success', 'animated', 'fadeIn');
				btnReg.disabled = false;
			} else {
				message2.innerHTML = 'Las contraseñas no coinciden <i class="fas fa-times ml-2"></i>';
				message2.classList.remove('ocult','text-success');
				message2.classList.add('text-danger', 'animated', 'fadeIn');
				btnReg.disabled = true;
			}
		} else {
			message2.textContent = '';
			message2.className = 'ocult mt-3';
			btnReg.disabled = false;
		}

	}

	/*----------  Listener password = reppassword  ----------*/

	passUs.addEventListener('keyup', contIgul);
	repPas.addEventListener('keyup', contIgul);
	

	/*----------  Send data register  ----------*/
	
	btnReg.addEventListener('click', (e) => {

		e.preventDefault( e );
		const formDat = new FormData($(formDa)[0]);
		if (nameUs.value.length > 0 && teleUs.value.length > 0 && mailUs.value.length > 0 && userUs.value.length > 0 && passUs.value.length > 0 && repPas.value.length > 0) {	
			divGod.classList.remove('d-none');
			btnReg.disabled = true;
			setTimeout(() => {
				$.ajax({
					url : "../ajax/reglogCli.php?oper=register",
					type : "POST", data : formDat,
					contentType : false, processData : false,
					success : ( resp ) => {
						if ( resp == 1 ) {
							divSus.classList.remove('d-none');
							setTimeout(() => {
								location.href = '../Login/';
							}, 4000);
						} else if ( resp == 2 ) {
							divFal.classList.remove('d-none');
							setTimeout(() => {
								location.reload();
							}, 1000);
						} else if ( resp == 490 ) {
							divCor.classList.remove('d-none');
							mailUs.focus();
							setTimeout(() => {
								divCor.classList.add('d-none');
							}, 3000);
						} else if ( resp == 480 ) {
							divUsr.classList.remove('d-none');
							userUs.focus();
							setTimeout(() => {
								divUsr.classList.add('d-none');
							}, 3000);
						} else {
							console.log( resp );
						}
					}
				});
				divGod.classList.add('d-none'); 
				btnReg.disabled = false;
			},1000);
		} else {
			divErr.classList.remove('d-none');
			setTimeout(() => {
				divErr.classList.add('d-none');
			}, 3000);
		}

	});


});