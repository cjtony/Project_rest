<div class="card o-hidden border-0 shadow-lg my-5">
  <div class="card-body p-0">
    <div class="row">
      <div class="col-lg-5 d-none d-lg-block bg-image"></div>
      <div class="col-lg-7">
        <div class="p-5">
          <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Crea una cuenta!</h1>
          </div>
          <form class="user mt-5" id="formDa" autocomplete="off">
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" name="nameUs" class="form-control form-control-user text-capitalize" id="nameUs" placeholder="Nombre completo">
              </div>
              <div class="col-sm-6">
                <input type="tel" name="teleUs" class="form-control form-control-user" id="teleUs" placeholder="Telefono">
              </div>
            </div>
            <div class="form-group">
              <input type="email" name="mailUs" class="form-control form-control-user" id="mailUs" placeholder="Correo electronico">
              <div id="textcorr" class="mt-3 mb-3 ml-3"></div>
            </div>
            <div class="form-group">
              <input type="text" name="userUs" class="form-control form-control-user" id="userUs" placeholder="Nombre de usuario">
            </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="password" name="passUs" class="form-control form-control-user" id="passUs" placeholder="Contraseña">
                <div id="message" class="mt-3 mb-3 ml-3"></div>
              </div>
              <div class="col-sm-6">
                <input type="password" name="repPas" class="form-control form-control-user" id="repPas" placeholder="Repite tu contraseña">
                <div id="message2" class="mt-3 mb-3 ml-3"></div>
              </div>
            </div>
            <div class="text-center mb-4 d-none mt-4" id="divGod">
              <div class="spinner-border text-success" role="status">
                <span class="sr-only">Loading...</span>
              </div>
              <h6 class="font-weight-bold mt-3 text-success">Cargando...</h6>
            </div>
            <div class="text-center mt-4 mb-4 rounded border-left-danger d-none" id="divErr">
              <span class="text-danger font-weight-bold">
                Completa todos los campos...
              </span>
            </div>
            <div class="text-center mt-4 mb-4 rounded border-left-warning d-none" id="divCor">
              <span class="text-warning font-weight-bold">
                El correo ya esta registrado
              </span>
            </div>
            <div class="text-center mt-4 mb-4 rounded border-left-warning d-none" id="divUsr">
              <span class="text-warning font-weight-bold">
                El usuario ya esta registrado
              </span>
            </div>
            <div class="text-center mt-4 mb-4 rounded border-left-danger d-none" id="divFal">
              <span class="text-danger font-weight-bold">
                Fallo el registro
              </span>
            </div>
            <div class="text-center mt-4 mb-4 rounded border-left-success d-none" id="divSus">
              <span class="text-success font-weight-bold">
                Registro correcto! redireccionando...
              </span>
            </div>
            <button class="btn col-btn btn-user text-white btn-block" id="btnReg">
              Registrar cuenta!
            </button>
          </form>
          <hr>
          <div class="text-center">
            <a class="small" href="<?php echo SERVERURL; ?>Login/">Ya tienes una cuenta? Inicia sesión</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo SERVERURL; ?>views/js/register.js"></script>