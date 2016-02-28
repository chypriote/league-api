<?php

	function getAllGames() {
		$sql = "select * FROM games";
		$regions = getAllRegions();
		$teams = getTeamsArray();
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$games = $stmt->fetchAll(PDO::FETCH_OBJ);
			foreach ($games as $game) {
				//Récup infos teams
				$game->region = $regions[$game->region]->name;
				$game->blue = $teams[$game->blue]->name;
				$game->red = $teams[$game->red]->name;
				$game->winner = ($game->winner == 1) ? $game->blue : $game->red;
				//Récup compos
				$game->blue_compo = getCompo($game->blue_compo);
				$game->red_compo = getCompo($game->red_compo);
				//Récup bans
				$game->blue_bans = getBans($game->blue_bans);
				$game->red_bans = getBans($game->red_bans);

			}
			return $games;
		} catch(PDOException $e) {
			return null;
		}
	}

	function getGame($id) {
		$sql = "select * FROM games WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$game = $stmt->fetchObject();
			//Récup infos teams
			$game->region = getRegion($game->region)->name;
			$game->blue = getTeam($game->blue)->name;
			$game->red = getTeam($game->red)->name;
			$game->winner = ($game->winner == 1) ? $game->blue : $game->red;
			//Récup compos
			$game->blue_compo = getCompo($game->blue_compo);
			$game->red_compo = getCompo($game->red_compo);
			//Récup bans
			$game->blue_bans = getBans($game->blue_bans);
			$game->red_bans = getBans($game->red_bans);
			return $game;
		} catch(PDOException $e) {
			return null;
		}
	}