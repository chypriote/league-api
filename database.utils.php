<?php
	function getConnection() {
		global $server, $database, $user, $password;

		$dbh = new PDO("mysql:host=$server;dbname=$database", $user, $password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $dbh;
	}

	function getGame($id) {
		$sql = "select * FROM games WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$game = $stmt->fetchObject();
			$game->region = getRegion($team->region)->name;
			return $game;
		} catch(PDOException $e) {
			return null;
		}
	}

	function getCompo($id) {
		$sql = "select * FROM compos WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$compo = $stmt->fetchObject();
			return $compo;
		} catch(PDOException $e) {
			return null;
		}
	}

	function getBans($id) {
		$sql = "select * FROM bans WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$ban = $stmt->fetchObject();
			return $ban;
		} catch(PDOException $e) {
			return null;
		}
	}

	function getChampion($id) {
		$sql = "select * FROM champions WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$champion = $stmt->fetchObject();
			return $champion;
		} catch(PDOException $e) {
			return null;
		}
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