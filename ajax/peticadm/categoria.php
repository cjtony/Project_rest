<?php

session_start();

if ($_SESSION['keyAdm'] == "" || $_SESSION['keyAdm'] == null) {
	header("Location:../../");
} else {
	include '../../models/rutas.php';
	include '../../models/connect.php';
	$fechAct = date("Y-m-d");
	$dbConexion = new Connect();
	$dbConexion = $dbConexion -> getDB();
	$keyAdm = $_SESSION['keyAdm'];
	$valid = 1;
	switch ($_GET['oper']) {

		case 'regcateg':
			
			$nameCat = isset($_POST['nameCat']) ? trim($_POST['nameCat']) : "";
			$descCat = isset($_POST['descCat']) ? trim($_POST['descCat']) : "";

			try {
				$validCateg = $dbConexion -> prepare("SELECT * FROM categoria WHERE nombre_cat = :nameCat");
				$validCateg -> bindParam("nameCat", $nameCat, PDO::PARAM_STR);
				$validCateg -> execute();
				$rowValidCateg = $validCateg -> rowCount();
				if ($rowValidCateg > 0) {
					echo "La categoria que intenta registrar ya se encuentra registrada";
				} else {
					$insertDat = $dbConexion -> prepare("INSERT INTO categoria (nombre_cat, descripcion_cat, estado_cat) VALUES (:nameCat, :descCat, :valid)");
					$insertDat -> bindParam("nameCat", $nameCat, PDO::PARAM_STR);
					$insertDat -> bindParam("descCat", $descCat, PDO::PARAM_STR);
					$insertDat -> bindParam("valid", $valid, PDO::PARAM_INT);
					$insertDat -> execute();
					if ($insertDat) {
						echo 1;
					} else {
						echo "Fallo la inserción";
					}
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null;
			}

			break;

		case 'editcat':

			$nameCat = isset($_POST['nameCat']) ? trim($_POST['nameCat']) : "";
			$descCat = isset($_POST['descCat']) ? trim($_POST['descCat']) : "";
			$estCat = isset($_POST['estCat']) ? trim($_POST['estCat']) : "";
			$id_categoria = isset($_POST['id_categoria']) ? trim($_POST['id_categoria']) : "";

			try {
				$validCateg = $dbConexion -> prepare("SELECT * FROM categoria WHERE nombre_cat = :nameCat && id_categoria != :id_categoria");
				$validCateg -> bindParam("nameCat", $nameCat, PDO::PARAM_STR);
				$validCateg -> bindParam("id_categoria", $id_categoria, PDO::PARAM_INT);
				$validCateg -> execute();
				$rowValidCateg = $validCateg -> rowCount();
				if ($rowValidCateg > 0) {
					echo "La categoria que intenta registrar ya se encuentra registrada";
				} else {
					$updateDat = $dbConexion -> prepare("UPDATE categoria SET nombre_cat = :nameCat, descripcion_cat = :descCat, estado_cat = :estCat WHERE id_categoria = :id_categoria");
					$updateDat -> bindParam("nameCat", $nameCat, PDO::PARAM_STR);
					$updateDat -> bindParam("descCat", $descCat, PDO::PARAM_STR);
					$updateDat -> bindParam("estCat", $estCat, PDO::PARAM_STR);
					$updateDat -> bindParam("id_categoria", $id_categoria, PDO::PARAM_INT);
					$updateDat -> execute();
					if ($updateDat) {
						echo 1;
					} else {
						echo "Fallo la inserción";
					}
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
			} finally {
				$dbConexion = null;
			}

			break;

		default:
			$dbConexion = null;
			break;
	}

}
