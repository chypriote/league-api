<?php

	function getAllRegions() {
		$sql = "select * FROM regions";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$regions = $stmt->fetchAll(PDO::FETCH_OBJ);
			foreach ($regions as $region) {
				$ret[$region->id] = $region;
			}
			return $ret;
		} catch(PDOException $e) {
			return null;
		}
	}