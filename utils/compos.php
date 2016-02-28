<?php

	function getCompo($id) {
		$sql = "select * FROM compos WHERE id=:id";
		try {
			$db = getConnection();
			$stmt = $db->prepare($sql);
			$stmt->bindParam("id", $id);
			$stmt->execute();
			$compo = $stmt->fetchObject();
			unset($compo->id);
			$compo->top = getChampionSlim($compo->top);
			$compo->jungle = getChampionSlim($compo->jungle);
			$compo->mid = getChampionSlim($compo->mid);
			$compo->adc = getChampionSlim($compo->adc);
			$compo->support = getChampionSlim($compo->support);

			return $compo;
		} catch(PDOException $e) {
			return null;
		}
	}