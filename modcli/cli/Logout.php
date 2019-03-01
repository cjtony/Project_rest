<?php 
session_start();
unset($_SESSION['keyCli']);
session_destroy();
header("Location:../../");