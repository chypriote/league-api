<?php

	function getAllTeams() {
		$sql = "select * FROM teams";
		$regions = getAllRegions();
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$teams = $stmt->fetchAll(PDO::FETCH_OBJ);
			foreach ($teams as $team) {
				$team->region = $regions[$team->region]->name;
			}
			return $teams;
		} catch(PDOException $e) {
			return null;
		}
	}

	function getTeam($id) {
		$sql = "select * FROM teams WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$team = $stmt->fetchObject();
			$team->region = getRegion($team->region)->name;
			return $team;
		} catch(PDOException $e) {
			return null;
		}
	}

	function getNbTeams() {
		$sql = "select COUNT(*) FROM teams";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$count = $stmt->fetchColumn();
			return $count;
		} catch(PDOException $e) {
			return null;
		}
	}
	
	function getNbGamesTeam($id) {
		$sql = "select COUNT(*) FROM games WHERE red=:id OR blue=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$count = $stmt->fetchColumn();
			return $count;
		} catch(PDOException $e) {
			return null;
		}
	}