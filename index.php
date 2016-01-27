<?php

require 'Slim/Slim.php';

$app = new Slim();

$app->get('/champions', 'getChampions');
$app->get('/champions/:id', 'getChampion');
$app->post('/champions', 'addChampion');
$app->put('/champions/:id', 'updateChampion');
$app->delete('/champions/:id',	'deleteChampion');
$app->get('/champions/search/:query', 'findChampionsByName');

$app->run();

function getChampions() {
	$sql = "select * FROM champions";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);
		$champions = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($champions);
	} catch(PDOException $e) {
		echo '{"error":{"text":' . $e->getMessage() . '}}';
	}
}
function getChampion($id) {
	$sql = "SELECT * FROM champions WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$champion = $stmt->fetchObject();
		$db = null;
		echo json_encode($champion);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}
function addChampion() {
	$request = Slim::getInstance()->request();
	$champion = json_decode($request->getBody());
	$sql = "INSERT INTO champions (name) VALUES (:name)";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("name", $champion->name);
		$stmt->execute();
		$champion->id = $db->lastInsertId();
		$db = null;
		echo json_encode($champion);
	} catch(PDOException $e) {
		echo '{"error":{"text":' . $e->getMessage() . '}}';
	}
}
function updateChampion($id) {
	$request = Slim::getInstance()->request();
	$body = $request->getBody();
	$champion = json_decode($body);
	$sql = "UPDATE champions SET 'name'=:name WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("name", $champion->name);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo json_encode($champion);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}
function deleteChampion($id) {
	$sql = "DELETE FROM champions WHERE id=:id";
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
function findChampionsByName($query) {
	$sql = "SELECT * FROM champions WHERE LOWER(name) LIKE :query ORDER BY name";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$query = "%".$query."%";
		$stmt->bindParam("query", $query);
		$stmt->execute();
		$champions = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"wine": ' . json_encode($champions) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function getConnection() {
	$dbhost="localhost";
	$dbuser="root";
	$dbpass="";
	$dbname="league";
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

?>