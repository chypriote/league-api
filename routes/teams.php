<?php
require 'utils/teams.php';

$app->group('/teams', function () {
	//get teams list
	$this->get('', function($req, $res, $args) {
			$teams =getAllTeams();
		if ($teams)
			return $res->withStatus(200)->write(json_encode($teams));
		else
			return $res->withStatus(400)->write($e->getMessage());
	})->setName('teams');

	//get team with id
	$this->get('/{id}', function($req, $res, $args){
		$team = getTeam($args['id']);
		if ($team)
			return $res->withStatus(200)->write(json_encode($team));
		else
			return $res->withStatus(400)->write($e->getMessage());
	});

	//post new team
	$this->post('', function($req, $res, $args) {
		$team = $req->getParsedBody();
		$sql = "INSERT INTO teams (region, name, logo, games, wins) VALUES (:region, :name, :logo, 0, 0)";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("region", $team['region']);
			$stmt->bindParam("name", $team['name']);
			$stmt->bindParam("logo", $team['logo']);
			$stmt->execute();
			$team['id'] = $db->lastInsertId();
			$db = null;
			return $res->withStatus(200)->write(json_encode($team));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	});

	// update team with id
	$this->put('/{id}', function($req, $res, $args) {
		$id = $args['id'];
		$team = $req->getParsedBody();
		$sql = "UPDATE teams SET 'region'=:region, name'=:name, 'logo'=:logo, 'games'=:games, 'wins'=:wins WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("region", $team['region']);
			$stmt->bindParam("name", $team['name']);
			$stmt->bindParam("logo", $team['logo']);
			$stmt->bindParam("games", $team['games']);
			$stmt->bindParam("wins", $team['wins']);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$db = null;
			return $res->withStatus(200)->write(json_encode($team));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	});

	//delete team with id
	$this->delete('/{id}', function($req, $res, $args) {
		$id = $args['id'];
		$sql = "DELETE FROM teams WHERE id=:id";
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

	//find by name
	$this->get('/search/{query}', function($req, $res, $args) {
		$query = $args['query'];
		$sql = "SELECT * FROM teams WHERE LOWER(name) LIKE :query ORDER BY name";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$query = "%".$query."%";
			$stmt->bindParam("query", $query);
			$stmt->execute();
			$teams = $stmt->fetchAll(PDO::FETCH_OBJ);
			$db = null;
			return $res->withStatus(200)->write(json_encode($teams));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	});
});