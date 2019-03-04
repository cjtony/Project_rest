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

	public function menuPri() {
		try {
			$bd = new Connect();
			$bd = $bd -> getDB();
			$stmt = $bd -> prepare("SELECT * FROM plat_menu LIMIT 4");
			$stmt -> execute();
			return $stmt;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$bd = null; $stmt = null;
		}
	}

	public function menuCat($clv) {
		try {
			$bd = new Connect();
			$bd = $bd -> getDB();
			$stmt = $bd -> prepare("SELECT * FROM categoria WHERE id_categoria = :clv");
			$stmt -> bindParam("clv", $clv, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$bd = null; $stmt = null; $data = null;
		}
	} 

	public function plaMenu($clv) {
		try {
			$bd = new Connect();
			$bd = $bd -> getDB();
			$stmt = $bd -> prepare("SELECT * FROM plat_menu pl INNER JOIN categoria ct ON ct.id_categoria = pl.id_categoria WHERE ct.id_categoria = :clv");
			$stmt -> bindParam("clv", $clv, PDO::PARAM_INT);
			$stmt -> execute();
			return $stmt;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$bd = null; $stmt = null;
		}
	}

	public function detailsPlat($clv) {
		try {
			$bd = new Connect();
			$bd = $bd -> getDB();
			$stmt = $bd -> prepare("SELECT * FROM plat_menu pl INNER JOIN categoria ct ON ct.id_categoria = pl.id_categoria WHERE pl.id_platillo = :clv");
			$stmt -> bindParam("clv", $clv, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$bd = null; $stmt = null; $data = null;
		}
	}

	public function orderComp($keyCli,$val) {
		try {
			$bd = new Connect();
			$bd = $bd -> getDB();
			$stmt = $bd -> prepare("SELECT * FROM carrito cr INNER JOIN plat_menu pt ON pt.id_platillo = cr.id_platillo  INNER JOIN clientes cl ON cl.id_cliente = cr.id_cliente INNER JOIN categoria ct ON ct.id_categoria = pt.id_categoria WHERE cl.id_cliente = :keyCli && cr.estad_car = :val");
			$stmt -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
			$stmt -> bindParam("val", $val, PDO::PARAM_INT);
			$stmt -> execute();
			return $stmt;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$bd = null; $stmt = null;
		}
	}

	public function direccCli($keyCli) {
		try {
			$bd = new Connect();
			$bd = $bd -> getDB();
			$stmt = $bd -> prepare("SELECT * FROM direcciones WHERE id_cliente = :keyCli");
			$stmt -> bindParam("keyCli", $keyCli, PDO::PARAM_INT);
			$stmt -> execute();
			return $stmt;
		} catch (PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		} finally {
			$bd = null; $stmt = null;
		}
	}

}