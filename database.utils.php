<?php
	function getConnection() {
		global $server, $database, $user, $password;

		$dbh = new PDO("mysql:host=$server;dbname=$database", $user, $password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $dbh;
	}

	function getRegion($id) {
		$sql = "select * FROM regions WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$region = $stmt->fetchObject();
			return $region;
		} catch(PDOException $e) {
			return null;
		}
	}