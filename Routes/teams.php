<?php

$app->get('teams', 'getTeams');
$app->get('/teams/:id', 'getTeam');
$app->post('/teams', 'addTeam');
$app->put('/teams/:id', 'updateTeam');
$app->delete('/teams/:id',	'deleteTeam');
$app->get('/teams/search/:query', 'findTeamsByName');

function getTeams() {
	$sql = "select * FROM teams";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);
		$teams = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($teams);
	} catch(PDOException $e) {
		echo '{"error":{"text":' . $e->getMessage() . '}}';
	}
}
function getTeam($id) {
	$sql = "SELECT * FROM teams WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$team = $stmt->fetchObject();
		$db = null;
		echo json_encode($team);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function addTeam() {
	$request = Slim::getInstance()->request();
	$team = json_decode($request->getBody());
	$sql = "INSERT INTO teams (name) VALUES (:name)";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("name", $team->name);
		$stmt->execute();
		$team->id = $db->lastInsertId();
		$db = null;
		echo json_encode($team);
	} catch(PDOException $e) {
		echo '{"error":{"text":' . $e->getMessage() . '}}';
	}
}

function updateTeam($id) {
	$request = Slim::getInstance()->request();
	$body = $request->getBody();
	$team = json_decode($body);
	$sql = "UPDATE teams SET 'name'=:name WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("name", $team->name);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo json_encode($team);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}
function deleteTeam($id) {
	$sql = "DELETE FROM teams WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}
function findTeamsByName($query) {
	$sql = "SELECT * FROM teams WHERE LOWER(name) LIKE :query ORDER BY name";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$query = "%".$query."%";
		$stmt->bindParam("query", $query);
		$stmt->execute();
		$teams = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"wine": ' . json_encode($teams) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}