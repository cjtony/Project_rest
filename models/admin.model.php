<?php 


/**
 * 
 */
class Administrador {
	
	function detailsAdmin($keyAdm) {
		try {
			$dbc = new Connect();
			$dbc = $dbc -> getDB();
			$stmt = $dbc -> prepare("SELECT * FROM admin WHERE id_admin = :keyAdm");
			$stmt -> bindParam("keyAdm", $keyAdm, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetch(PDO::FETCH_OBJ);
			return $data;
		} catch (PDOException $e) {
			echo '{"error":{"text":'.$e->getMessage().'}}';
		} finally {
			$dbc = null; $stmt = null; $data = null;
		}
	}
	
}