<?php 
  if (isset($_GET['view'])) {
    $views = explode("/", $_GET['view']);
    if (is_file('cli/'.$views[0].'.php')) {
      include 'cli/'.$views[0].'.php';
    } else {
      include 'cli/Index.php';
    }
  } else {
    include 'cli/Index.php';
  }
?>
