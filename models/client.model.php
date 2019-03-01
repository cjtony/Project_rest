<?php 

/**
 * 
 */

include 'connect.php';

class Client {
	
	/*function __construct(argument)
	{
		# code...
	}*/

	public function catDetails() {
		try {
			$valid = 1;
			$bd = new Connect();
			$bd = $bd -> getDB();
			$stmt = $bd -> prepare("SELECT * FROM categoria WHERE estado_cat = :valid");
			$stmt -> bindParam("valid", $valid, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$bd = null; $stmt = null;
		}
	}

	public function menuCat($param) {
		try {
			$bd = new Connect();
			$bd = $bd -> getDB();
			$stmt = $bd -> prepare("SELECT * FROM categoria WHERE id_categoria = :param");
			$stmt -> bindParam("param", $param, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {

		}
	}

}