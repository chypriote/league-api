<?php

/**
 * Created by PhpStorm.
 * User: nicol
 * Date: 28/01/2016
 * Time: 01:29
 */

namespace Model;

class Champion {
	protected $id;
	protected $name;
	protected $bans;
	protected $games;
	protected $wins;

	public function __construct(array $data) {
		foreach ($data as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getBans() {
		return $this->bans;
	}

	/**
	 * @param mixed $bans
	 */
	public function setBans($bans) {
		$this->bans = $bans;
	}

	/**
	 * @return mixed
	 */
	public function getGames() {
		return $this->games;
	}

	/**
	 * @param mixed $games
	 */
	public function setGames($games) {
		$this->games = $games;
	}

	/**
	 * @return mixed
	 */
	public function getWins() {
		return $this->wins;
	}

	/**
	 * @param mixed $wins
	 */
	public function setWins($wins) {
		$this->wins = $wins;
	}

}