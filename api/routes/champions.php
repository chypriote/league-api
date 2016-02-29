<?php

require "api/utils/champions.php";

$app->group('/champions', function () {

	/**
	 * @api {get} /champions Get a list of all champions
	 * @apiName GetChampions
	 * @apiVersion 1.0.0
	 * @apiSuccess {Array} champions List of champions
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *     [{
	 *       "name": "Champion",
	 *       "slug": "champ",
	 *       "games": 4,
	 *       "wins": 2,
	 *       "bans": 1
	 *     },
	 *	   {
	 *       "name": "Champion",
	 *       "slug": "champ",
	 *       "games": 6,
	 *       "wins": 3,
	 *       "bans": 2
	 *     }]
	 */
	$this->get('', function($req, $res, $args) {
		$champions = \Champion::all();

		if ($champions)
			return $res->withStatus(200)->write($champions->toJson());
		else
			return $res->withStatus(400)->write($e->getMessage());
	})->setName('champions');

	/**
	 * @api {get} /champions/:id Get the champion with the provided id
	 * @apiName GetChampion
	 * @apiVersion 1.0.0
	 * @apiSuccess {Object} champion Champion infos
	 */
	$this->get('/{id}', function($req, $res, $args){
		$champion = \Champion::find($args['id']);

		if ($champion)
			return $res->withStatus(200)->write($champion->toJson());
		else
			return $res->withStatus(400)->write($e->getMessage());
	});

	/**
	 * @api {post} /champions Create a new champion
	 * @apiName PostChampion
	 * @apiVersion 1.0.0
	 * @apiSuccess {Object} champion Champion created
	 */
	$this->post('', function($req, $res, $args) {
		$champion = new \Champion;
		$body = $req->getParsedBody();
		$champion->name = $body['name'];
		$champion->slug = $body['slug'];
		$champion->save();

		if ($champion)
			return $res->withStatus(200)->write($champion->toJson());
		else
			return $res->withStatus(400)->write('{"error":"there was an error processing your request"}');
	});

	/**
	 * @api {put} /champions/:id Updates the champion with ID
	 * @apiName UpdateChampion
	 * @apiVersion 1.0.0
	 * @apiSuccess {Object} champion Champion updated
	 */
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

	/**
	 * @api {delete} /champions/:id Delete the champion with ID
	 * @apiName DeleteChampion
	 * @apiVersion 1.0.0
	 */
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

	/**
	 * @api {get} /champions/search/:query Search for a champion with query
	 * @apiName QueryChampion
	 * @apiVersion 1.0.0
	 * @apiSuccess {Object} champion Champion found
	 */
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