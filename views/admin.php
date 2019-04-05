<div class="row justify-content-center">
  <div class="col-xl-10 col-lg-12 col-md-9">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-lg-6 d-none d-lg-block bg-image"></div>
          <div class="col-lg-6">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Bienvenido nuevamente administrador</h1>
              </div>
              <form class="user mt-5" id="formDa" autocomplete="off">
                <div class="form-group">
                  <input type="email" name="userUs" class="form-control form-control-user" id="userUs" aria-describedby="emailHelp" placeholder="Usuario...">
                </div>
                <div class="form-group">
                  <input type="password" name="passUs" class="form-control form-control-user" id="passUs" placeholder="Contraseña">
                </div>
                <div class="text-center mt-4 mb-4 d-none" id="divGod">
                  <div class="spinner-border text-success" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                  <h6 class="text-center text-success mt-2">
                    Validando datos...
                  </h6>
                </div>
                <div class="text-center mt-4 mb-4 rounded border-left-danger d-none" id="divErr">
                  <span class="text-danger font-weight-bold">
                    Completa todos los campos...
                  </span>
                </div>
                <div class="text-center mt-4 mb-4 rounded border-left-danger d-none" id="divFal">
                  <span class="text-danger font-weight-bold">
                    Datos incorrectos
                  </span>
                </div>
                <div class="text-center mt-4 mb-4 rounded border-left-success d-none" id="divSus">
                  <span class="text-success font-weight-bold">
                    Registro correcto! redireccionando...
                  </span>
                </div>
                <button id="btnIni" class="btn col-btn text-white btn-user btn-block mt-5">
                  Iniciar sesión
                </button>
              </form>
              <hr>
              <div class="text-center mt-4">
                <a class="small" href="<?php echo SERVERURL; ?>Register/">Crear una cuenta</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo SERVERURL; ?>views/js/admin.js"></script>