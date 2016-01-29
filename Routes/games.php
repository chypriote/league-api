<?php

$app->group('/games', function () {
	//get games list
	$this->get('', function($req, $res, $args) {
		$sql = "select * FROM games";
		try {
			$db = getConnection();
			$stmt = $db->query($sql);
			$games = $stmt->fetchAll(PDO::FETCH_OBJ);
			$db = null;
			return $res->withStatus(200)->write(json_encode($games));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	})->setName('games');


	//get ban with id
	$this->get('/{id}', function($req, $res, $args){
		$id = $args['id'];
		$sql = "SELECT * FROM games WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$ban = $stmt->fetchObject();
			$db = null;
			return $res->withStatus(200)->write(json_encode($ban));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	});

	//post new ban
	$this->post('', function($req, $res, $args) {
		$ban = $req->getParsedBody();
		$sql = "INSERT INTO games (region, date, blue, red, blue_compo, red_compo, blue_bans, red_bans, winner) VALUES (:region, :date, :blue, :red, :blueCompo, :redCompo, :blueBans, :redBans, :winner)";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("region", $ban->region);
			$stmt->bindParam("date", $ban->date);
			$stmt->bindParam("blue", $ban->blue);
			$stmt->bindParam("red", $ban->red);
			$stmt->bindParam("blue", $ban->blue);
			$stmt->bindParam("blueCompo", $ban->blue_compo);
			$stmt->bindParam("redCompo", $ban->red_compo);
			$stmt->bindParam("blueBans", $ban->blue_bans);
			$stmt->bindParam("redBans", $ban->red_bans);
			$stmt->execute();
			$ban->id = $db->lastInsertId();
			$db = null;
			return $res->withStatus(200)->write(json_encode($ban));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	});

	// update ban with id
	$this->put('/{id}', function($req, $res, $args) {
		$id = $args['id'];
		$ban = $req->getParsedBody();
		$sql = "UPDATE games SET 'region'=:region, 'date'=:date, 'blue'=:blue, 'red'=:red, 'blue_compo'=:blueCompo, 'red_compo'=:redCompo, 'blue_bans'=:blueBans, 'red_bans'=:redBans, 'winner'=:winner WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("region", $ban->region);
			$stmt->bindParam("date", $ban->date);
			$stmt->bindParam("blue", $ban->blue);
			$stmt->bindParam("red", $ban->red);
			$stmt->bindParam("blue", $ban->blue);
			$stmt->bindParam("blueCompo", $ban->blue_compo);
			$stmt->bindParam("redCompo", $ban->red_compo);
			$stmt->bindParam("blueBans", $ban->blue_bans);
			$stmt->bindParam("redBans", $ban->red_bans);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$db = null;
			return $res->withStatus(200)->write(json_encode($ban));
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