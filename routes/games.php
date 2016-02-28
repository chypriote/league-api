<?php

require 'utils/games.php';

$app->group('/games', function () {
	//get games list
	$this->get('', function($req, $res, $args) {
		$games = getAllGames();
		if ($games)
			return $res->withStatus(200)->write(json_encode($games));
		else
			return $res->withStatus(400)->write($e->getMessage());
	})->setName('games');


	//get ban with id
	$this->get('/{id}', function($req, $res, $args){
		$game = getGame($args['id']);
		if ($game)
			return $res->withStatus(200)->write(json_encode($game));
		else
			return $res->withStatus(400)->write($e->getMessage());
	});

	//post new ban
	$this->post('', function($req, $res, $args) {
		$game = $req->getParsedBody();
		$sql = "INSERT INTO games (region, date, blue, red, blue_compo, red_compo, blue_bans, red_bans, winner) VALUES (:region, :date, :blue, :red, :blueCompo, :redCompo, :blueBans, :redBans, :winner)";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("region", $game['region']);
			$stmt->bindParam("date", $game['date']);
			$stmt->bindParam("blue", $game['blue']);
			$stmt->bindParam("red", $game['red']);
			$stmt->bindParam("blueCompo", $game['blue_compo']);
			$stmt->bindParam("redCompo", $game['red_compo']);
			$stmt->bindParam("blueBans", $game['blue_bans']);
			$stmt->bindParam("redBans", $game['red_bans']);
			$stmt->bindParam("winner", $game['winner']);
			$stmt->execute();
			$game['id'] = $db->lastInsertId();
			$db = null;
			return $res->withStatus(200)->write(json_encode($game));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	});

	// update ban with id
	$this->put('/{id}', function($req, $res, $args) {
		$id = $args['id'];
		$game = $req->getParsedBody();
		$sql = "UPDATE games SET 'region'=:region, 'date'=:date, 'blue'=:blue, 'red'=:red, 'blue_compo'=:blueCompo, 'red_compo'=:redCompo, 'blue_bans'=:blueBans, 'red_bans'=:redBans, 'winner'=:winner WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("region", $game['region']);
			$stmt->bindParam("date", $game['date']);
			$stmt->bindParam("blue", $game['blue']);
			$stmt->bindParam("red", $game['red']);
			$stmt->bindParam("blue", $game['blue']);
			$stmt->bindParam("blueCompo", $game['blue_compo']);
			$stmt->bindParam("redCompo", $game['red_compo']);
			$stmt->bindParam("blueBans", $game['blue_bans']);
			$stmt->bindParam("redBans", $game['red_bans']);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$db = null;
			return $res->withStatus(200)->write(json_encode($game));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	});

	//delete ban with id
	$this->delete('/{id}', function($req, $res, $args) {
		$id = $args['id'];
		$sql = "DELETE FROM games WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$db = null;
			return $res->withStatus(200);
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	});
});