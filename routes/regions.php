<?php

require 'utils/regions.php';

$app->group('/regions', function () {
	//get regions list
	$this->get('', function($req, $res, $args) {
		$sql = "select * FROM regions";
		try {
			$db = getConnection();
			$stmt = $db->query($sql);
			$regions = $stmt->fetchAll(PDO::FETCH_OBJ);
			$db = null;
			return $res->withStatus(200)->write(json_encode($regions));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	})->setName('regions');

	//get region with id
	$this->get('/{id}', function($req, $res, $args){
		$id = $args['id'];
		$sql = "SELECT * FROM regions WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$region = $stmt->fetchObject();
			$db = null;
			return $res->withStatus(200)->write(json_encode($region));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	});

	//post new region
	$this->post('', function($req, $res, $args) {
		$region = $req->getParsedBody();
		$sql = "INSERT INTO regions (name, country) VALUES (:name, :country)";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("name", $region->name);
			$stmt->bindParam("country", $region->country);
			$stmt->execute();
			$region->id = $db->lastInsertId();
			$db = null;
			return $res->withStatus(200)->write(json_encode($region));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	});

	// update region with id
	$this->put('/{id}', function($req, $res, $args) {
		$id = $args['id'];
		$region = $req->getParsedBody();
		$sql = "UPDATE regions SET name'=:name, 'country'=:country WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("name", $region->name);
			$stmt->bindParam("country", $region->country);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$db = null;
			return $res->withStatus(200)->write(json_encode($region));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	});

	//delete region with id
	$this->delete('/{id}', function($req, $res, $args) {
		$id = $args['id'];
		$sql = "DELETE FROM regions WHERE id=:id";
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