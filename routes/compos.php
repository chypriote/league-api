<?php

require 'utils/compos.php';

$app->group('/compos', function () {
	//get compos list
	$this->get('', function($req, $res, $args) {
		$sql = "select * FROM compos";
		try {
			$db = getConnection();
			$stmt = $db->query($sql);
			$compos = $stmt->fetchAll(PDO::FETCH_OBJ);
			$db = null;
			return $res->withStatus(200)->write(json_encode($compos));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	})->setName('compos');

	//get compo with id
	$this->get('/{id}', function($req, $res, $args){
		$id = $args['id'];
		$sql = "SELECT * FROM compos WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$compo = $stmt->fetchObject();
			$db = null;
			return $res->withStatus(200)->write(json_encode($compo));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	});

	//post new compo
	$this->post('', function($req, $res, $args) {
		$compo = $req->getParsedBody();
		$sql = "INSERT INTO compos (top, jungle, mid, adc, support) VALUES (:top, :jungle, :mid, :adc, :support)";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("top", $compo['top']);
			$stmt->bindParam("jungle", $compo['jungle']);
			$stmt->bindParam("mid", $compo['mid']);
			$stmt->bindParam("adc", $compo['adc']);
			$stmt->bindParam("support", $compo['support']);
			$stmt->execute();
			$compo['id'] = $db->lastInsertId();
			$db = null;
			return $res->withStatus(200)->write(json_encode($compo));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	});

	// update compo with id
	$this->put('/{id}', function($req, $res, $args) {
		$id = $args['id'];
		$compo = $req->getParsedBody();
		$sql = "UPDATE compos SET 'top'=:top, jungle'=:jungle, 'mid'=:mid, 'adc'=:adc, 'support'=:support WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("top", $compo['top']);
			$stmt->bindParam("jungle", $compo['jungle']);
			$stmt->bindParam("mid", $compo['mid']);
			$stmt->bindParam("adc", $compo['adc']);
			$stmt->bindParam("support", $compo['support']);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$db = null;
			return $res->withStatus(200)->write(json_encode($compo));
		} catch(PDOException $e) {
			return $res->withStatus(400)->write($e->getMessage());
		}
	});

	//delete compo with id
	$this->delete('/{id}', function($req, $res, $args) {
		$id = $args['id'];
		$sql = "DELETE FROM compos WHERE id=:id";
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