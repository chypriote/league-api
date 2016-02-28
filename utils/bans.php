<?php

	function getBans($id) {
		$sql = "select * FROM bans WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$ban = $stmt->fetchObject();
			unset($ban->id);
			$ban->first = getChampionSlim($ban->first);
			$ban->second = getChampionSlim($ban->second);
			$ban->third = getChampionSlim($ban->third);

			return $ban;
		} catch(PDOException $e) {
			return null;
		}
	}