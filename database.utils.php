<?php

	function getGame($id) {
		$sql = "select * FROM games WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$game = $stmt->fetchObject();
		} catch(PDOException $e) {
			return null;
		}
		return $game;
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

	function getTeam($id) {
		$sql = "select * FROM teams WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$team = $stmt->fetchObject();
			return $team;
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