<?php 

session_start();

if ($_SESSION['keyAdm'] == "" || $_SESSION['keyAdm'] == null) {
  header('Location:../');
} else {
  include '../models/rutas.php';
  include '../models/admin.model.php';
  include '../models/connect.php';
  $keyAdm = $_SESSION['keyAdm'];
  $admin = new Administrador();
  $dataAdmin  = $admin -> detailsAdmin($keyAdm);
  function formatFech($fechForm) {
    $fechDat = substr($fechForm, 0,4);
    $fechM = substr($fechForm, 5,2);
    $fechD = substr($fechForm, 8,2);
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $Fecha = date($fechD)." de ".$meses[date($fechM)-1]. " del ".date($fechDat);
    return $Fecha;
  }
    
?>

<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>CoDeX</title>

  
  <link href="<?php echo SERVERURL; ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?php echo SERVERURL; ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo SERVERURLADM; ?>css/styles.css">
  <link href="<?php echo SERVERURL; ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="<?php echo SERVERURL; ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo SERVERURL; ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo SERVERURL; ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

</head>

<body id="page-top">

  <div id="wrapper">

    <ul class="navbar-nav back-col sidebar sidebar-dark accordion" id="accordionSidebar">

      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo SERVERURLADM; ?>Home/">
        <div class="sidebar-brand-text" style="letter-spacing: .5em;">Playita</div>
      </a>

      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        Opciones
      </div>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUpd" aria-expanded="true" aria-controls="collapseUpd">
          <i class="fas fa-fw fa-cogs"></i>
          <span>Ajustes</span>
        </a>
        <div id="collapseUpd" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Selecciona:</h6>
            <a class="collapse-item" href="<?php echo SERVERURLADM; ?>confPass/">Contraseña</a>
            <a class="collapse-item" href="<?php echo SERVERURLADM; ?>confData/">Mis datos</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRegisters" aria-expanded="true" aria-controls="collapseRegisters">
          <i class="fas fa-fw fa-book-open"></i>
          <span>Menu</span>
        </a>
        <div id="collapseRegisters" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Selecciona:</h6>
            <a class="collapse-item" href="<?php echo SERVERURLADM; ?>regCateg/">
              <i class="fas fa-plus mr-2"></i>
              Categoría
            </a>
            <a class="collapse-item" href="<?php echo SERVERURLADM; ?>regPlat/">
              <i class="fas fa-plus mr-2"></i>
              Platillo
            </a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTables" aria-expanded="true" aria-controls="collapseTables">
          <i class="fas fa-fw fa-eye"></i>
          <span>Datos</span>
        </a>
        <div id="collapseTables" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Selecciona:</h6>
            <a class="collapse-item" href="<?php echo SERVERURLADM; ?>tableCateg/">
              <i class="fas fa-table mr-2"></i>
              Categorias
            </a>
            <a class="collapse-item" href="<?php echo SERVERURLADM; ?>tablePlat/">
              <i class="fas fa-table mr-2"></i>
              Platillos
            </a>
            <a class="collapse-item" href="<?php echo SERVERURLADM; ?>tableEmp/">
              <i class="fas fa-table mr-2"></i>
              Empleados
            </a>
            <a class="collapse-item" href="<?php echo SERVERURLADM; ?>tableCli/">
              <i class="fas fa-table mr-2"></i>
              Clientes
            </a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNumbers" aria-expanded="true" aria-controls="collapseNumbers">
          <i class="fas fa-fw fa-chart-bar"></i>
          <span>Numeros</span>
        </a>
        <div id="collapseNumbers" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Selecciona:</h6>
            <a class="collapse-item" href="<?php echo SERVERURLADM; ?>RegistersNumbers/">Principal</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
          <i class="fas fa-fw fa-user-tie"></i>
          <span>Empleados</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Selecciona:</h6>
            <a class="collapse-item" href="<?php echo SERVERURLADM; ?>regEmp/">Registrar</a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider d-none d-md-block">

      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>

    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <div id="message_search" class="rounded border-bottom-danger p-1 d-none">
            <span class="text-danger">Ingresa al menos 3 caracteres</span>
          </div>

          <!-- <form method="POST" id="form_search" action="<?php echo SERVERURLADM; ?>ResultsSearch/" autocomplete="off" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input class="form-control bg-light border-0 small" placeholder="Buscar expediente..." aria-label="Search" aria-describedby="basic-addon2" value="" name="search_cli" type="search" id="search_cli">
              <div class="input-group-append">
                <button class="btn btn-col" type="submit" id="btn_search">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form> -->

          <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <!-- <form class="form-inline mr-auto w-100 navbar-search" method="POST" id="form_search2" action="<?php echo SERVERURLADM; ?>ResultsSearch/" autocomplete="off">
                  <div class="input-group">
                    <input value="" name="search_cli" type="search" id="search_cli2" class="form-control bg-light border-0 small" placeholder="Buscar expediente..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit" id="btn_search2">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form> -->
              </div>
            </li>

            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <?php 
                    $dbc = new Connect();
                    $dbc = $dbc -> getDB();
                    $valid = 1;
                    $countNotif = $dbc -> prepare("SELECT DISTINCTROW dp.cod_conf AS 'COD' FROM det_pedido dp WHERE confirm_ped = :valid");
                    $countNotif -> bindParam("valid", $valid, PDO::PARAM_INT);
                    $countNotif -> execute();
                    $rowCountNotif = $countNotif -> rowCount();
                ?>
                    <span class="badge badge-danger badge-counter"> + <?php echo $rowCountNotif; ?></span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header bg-success border-0">
                  Pedidos
                </h6>
                <?php 
                  while ( $dn = $countNotif -> fetch(PDO::FETCH_OBJ) ) {
                    $codigo = $dn -> COD; 
                    $dataNotif = $dbc -> prepare("SELECT * FROM det_pedido WHERE confirm_ped = :valid && cod_conf = :codigo LIMIT 1");
                    $dataNotif -> bindParam("valid", $valid, PDO::PARAM_INT);
                    $dataNotif -> bindParam("codigo", $codigo, PDO::PARAM_STR);
                    $dataNotif -> execute();
                    while ($dno = $dataNotif -> fetch(PDO::FETCH_OBJ)) {
                ?>
                    <a class="dropdown-item d-flex align-items-center" href="<?php echo SERVERURLADM; ?>detPed/<?php echo $dno->cod_conf; ?>/">
                      <div class="mr-3">
                        <div class="icon-circle bg-primary">
                          <i class="fas fa-file-alt text-white"></i>
                        </div>
                      </div>
                      <div>
                        <div class="small text-gray-500"><?php echo $dno->fecha_hora_ped; ?></div>
                        <span class="font-weight-bold">
                          <b>Codigo de pedido:</b>
                          <span class="badge badge-success ml-1 mr-1 p-2">
                            <?php echo $dno->cod_conf; ?>
                          </span>
                        </span>
                      </div>
                    </a>
                <?php
                    }
                  }
                ?>
                <a class="dropdown-item text-center small text-gray-500" href="#">Ver todos los pedidos</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small text-capitalize font-weight-bold">
                  <?php echo $dataAdmin->usuario_adm; ?>
                </span>
                  <img src='<?php echo SERVERURL; ?>assets/img/avatar-dhg.png' class="img-profile rounded-circle">
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Salir
                </a>
              </div>
            </li>

          </ul>

        </nav>


        <?php 
          if (isset($_GET['view'])) {
              $views = explode("/", $_GET['view']);
              if (is_file('adm/'.$views[0].'.php')) { {}
                  include 'adm/'.$views[0].'.php';
              } else {
                  include 'adm/Index.php';
              }
          } else {
              include 'adm/Index.php';
          }
        ?>
      

        

      </div>

      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span> 
              <i class="fas fa-copyright mr-2"></i>
              <script type="text/javascript">
                document.write(new Date().getFullYear());
              </script>
            </span>
          </div>
        </div>
      </footer>

    </div>

  </div>

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Esta seguro de cerrar sesion?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body text-center">
          Seleccione salir para continuar...
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-dark" href="<?php echo SERVERURLADM; ?>adm/Logout.php">Salir</a>
        </div>
      </div>
    </div>
  </div>

  <script src="<?php echo SERVERURL; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo SERVERURL; ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo SERVERURL; ?>assets/js/sb-admin-2.min.js"></script>


  
</body>

</html>

<?php   
  // } else {
  //   header("Location:".SERVERURLDEV."dev/Logout.php");
  // }
}

?>

