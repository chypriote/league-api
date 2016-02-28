<?php

require 'api/utils/bans.php';

$app->group('/bans', function () {
	//get bans list
	$this->get('', function($req, $res, $args) {
		$sql = "select * FROM bans";
		try {
			$db = getConnection();
			$stmt = $db->query($sql);
			$bans = $stmt->fetchAll(PDO::FETCH_OBJ);
			$db = null;
			return $res->withStatus(200)->write(json_encode($bans));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	})->setName('bans');

	//get ban with id
	$this->get('/{id}', function($req, $res, $args){
		$id = $args['id'];
		$sql = "SELECT * FROM bans WHERE id=:id";
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
		$sql = "INSERT INTO bans (first, second, third) VALUES (:first, :second, :third)";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("first", $ban['first']);
			$stmt->bindParam("second", $ban['second']);
			$stmt->bindParam("third", $ban['third']);
			$stmt->execute();
			$ban['id'] = $db->lastInsertId();
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
		$sql = "UPDATE bans SET 'first'=:first, 'second'=:second, 'third'=:third WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("first", $ban['first']);
			$stmt->bindParam("second", $ban['second']);
			$stmt->bindParam("third", $ban['third']);
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
		$sql = "DELETE FROM bans WHERE id=:id";
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