<?php include 'models/rutas.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>La playita del brody</title>
  <link href="<?php echo SERVERURL; ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?php echo SERVERURL; ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?php echo SERVERURL; ?>assets/css/styles.css" rel="stylesheet">
  <script src="<?php echo SERVERURL; ?>assets/vendor/jquery/jquery.min.js"></script>
</head>

<body class="bg-are">

  <div class="container">

    <?php 
      if (isset($_GET['view'])) {
        $views = explode("/", $_GET['view']);
        if (is_file('views/'.$views[0].'.php')) {
          include 'views/'.$views[0].'.php';
        } else {
          include 'views/Index.php';
        }
      } else {
        include 'views/Index.php';
      }
    ?>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo SERVERURL; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo SERVERURL; ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo SERVERURL; ?>assets/js/sb-admin-2.min.js"></script>

</body>

</html>
