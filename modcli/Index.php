<?php 

session_start();

if ($_SESSION['keyCli'] == "" || $_SESSION['keyCli'] == null) {
  header("Location:../");
} else {
  
  include '../models/rutas.php';
  include '../models/client.model.php';

  $keyCli = $_SESSION['keyCli'];

  $climodel = new Client();

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

  <title>La playita</title>

  
  <link href="<?php echo SERVERURL; ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
  <link href="<?php echo SERVERURL; ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>assets/css/animate.css">
  <link href="<?php echo SERVERURL; ?>assets/css/styles.css" rel="stylesheet">
  <link href="<?php echo SERVERURL; ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
 
  <script src="<?php echo SERVERURL; ?>assets/vendor/jquery/jquery.min.js"></script>

  <script src="<?php echo SERVERURL; ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo SERVERURL; ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

</head>
<body id="page-top">
  <nav class="navbar navbar-expand-lg navbar-white bg-white">
    <a class="navbar-brand col-let ml-3" href="<?php echo SERVERURLCLI; ?>Home/">
      <i class="fas fa-utensils fa-2x"></i>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars col-let fa-2x"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active ml-3">
          <a class="nav-link font-weight-bold" href="<?php echo SERVERURLCLI; ?>Home/">Inicio<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item ml-3">
          <a class="nav-link font-weight-bold" href="<?php echo SERVERURLCLI; ?>Menu/">Menu</a>
        </li>
        <li class="nav-item ml-3">
          <a class="nav-link font-weight-bold" href="#">
            Notificaciones
            <sup><span class="badge badge-pill badge-danger">2</span>
          </a>
        </li>
        <li class="nav-item ml-3">
          <a class="nav-link font-weight-bold" href="<?php echo SERVERURLCLI; ?>MyOrders/">Mis pedidos</a>
        </li>
        <li class="nav-item ml-3">
          <a class="nav-link font-weight-bold" href="<?php echo SERVERURLCLI; ?>MyOrders/">Mi carrito</a>
        </li>
        <li class="nav-item ml-3">
          <a class="nav-link font-weight-bold" href="<?php echo SERVERURLCLI; ?>cli/Logout.php">Salir</a>
        </li>
      </ul>
      <div class="form-inline my-2 my-lg-0">
        <h2 class="font-weight-bold col-let">
          La Playita del Brody...
        </h2>
      </div>
    </div>
  </nav>

    <?php 
          if (isset($_GET['view'])) {
              $views = explode("/", $_GET['view']);
              if (is_file('cli/'.$views[0].'.php')) { {}
                  include 'cli/'.$views[0].'.php';
              } else {
                  include 'cli/Index.php';
              }
          } else {
              include 'cli/Index.php';
          }
        ?>


      <footer class="sticky-footer bg-white mt-5">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span> 
              <i class="fas fa-copyright mr-2"></i>
              -- MA 
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
