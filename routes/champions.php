<?php

require "utils/champions.php";

$app->group('/champions', function () {

	/**
	 * @api {get} /champions Get a list of all champions
	 * @apiName GetChampions
	 * @apiVersion 1.0.0
	 * @apiSuccess {Array} champions List of champions
	 */
	$this->get('', function($req, $res, $args) {
		$champions = getAllChampions();
		if ($champions)
			return $res->withStatus(200)->write(json_encode($champions));
		else
			return $res->withStatus(400)->write($e->getMessage());
	})->setName('champions');

	//get champion with id
	$this->get('/{id}', function($req, $res, $args){
		$champion = getChampion($args['id']);
		if ($champion)
			return $res->withStatus(200)->write(json_encode($champion));
		else
			return $res->withStatus(400)->write($e->getMessage());
	});

	//post new champion
	$this->post('', function($req, $res, $args) {
		$champion = addChampion($req->getParsedBody());
		if ($champion)
			return $res->withStatus(200)->write(json_encode($champion));
		else
			return $res->withStatus(400)->write('{"error":"there was an error processing your request"}');
	});

	// update champion with id
	$this->put('/{id}', function($req, $res, $args) {
		$id = $args['id'];
		$champion = $req->getParsedBody();
		return json_encode($champion);
		$sql = "UPDATE champions SET 'name'=:name, 'bans'=:bans, 'games'=:games, 'wins'=:wins WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("name", $champion['name']);
			$stmt->bindParam("bans", $champion['bans']);
			$stmt->bindParam("games", $champion['games']);
			$stmt->bindParam("wins", $champion['wins']);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$db = null;
			return $res->withStatus(200)->write(json_encode($champion));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	});

	//delete champion with id
	$this->delete('/{id}', function($req, $res, $args) {
		$id = $args['id'];
		$sql = "DELETE FROM champions WHERE id=:id";
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
		$sql = "SELECT * FROM champions WHERE LOWER(name) LIKE :query ORDER BY name";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$query = "%".$query."%";
			$stmt->bindParam("query", $query);
			$stmt->execute();
			$champions = $stmt->fetchAll(PDO::FETCH_OBJ);
			$db = null;
			return $res->withStatus(200)->write(json_encode($champions));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	});
});