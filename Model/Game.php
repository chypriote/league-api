<?php

/**
 * Created by PhpStorm.
 * User: nicol
 * Date: 28/01/2016
 * Time: 01:32
 */

namespace Model;

class Game {
	protected $id;
	protected $region;
	protected $date;
	protected $blue;
	protected $red;
	protected $blueCompo;
	protected $redCompo;
	protected $blueBans;
	protected $redBans;
	protected $winner;

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
	public function getRegion() {
		return $this->region;
	}

	/**
	 * @param mixed $region
	 */
	public function setRegion($region) {
		$this->region = $region;
	}

	/**
	 * @return mixed
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * @param mixed $date
	 */
	public function setDate($date) {
		$this->date = $date;
	}

	/**
	 * @return mixed
	 */
	public function getBlue() {
		return $this->blue;
	}

	/**
	 * @param mixed $blue
	 */
	public function setBlue($blue) {
		$this->blue = $blue;
	}

	/**
	 * @return mixed
	 */
	public function getRed() {
		return $this->red;
	}

	/**
	 * @param mixed $red
	 */
	public function setRed($red) {
		$this->red = $red;
	}

	/**
	 * @return mixed
	 */
	public function getBlueCompo() {
		return $this->blueCompo;
	}

	/**
	 * @param mixed $blueCompo
	 */
	public function setBlueCompo($blueCompo) {
		$this->blueCompo = $blueCompo;
	}

	/**
	 * @return mixed
	 */
	public function getRedCompo() {
		return $this->redCompo;
	}

	/**
	 * @param mixed $redCompo
	 */
	public function setRedCompo($redCompo) {
		$this->redCompo = $redCompo;
	}

	/**
	 * @return mixed
	 */
	public function getBlueBans() {
		return $this->blueBans;
	}

	/**
	 * @param mixed $blueBans
	 */
	public function setBlueBans($blueBans) {
		$this->blueBans = $blueBans;
	}

	/**
	 * @return mixed
	 */
	public function getRedBans() {
		return $this->redBans;
	}

	/**
	 * @param mixed $redBans
	 */
	public function setRedBans($redBans) {
		$this->redBans = $redBans;
	}

	/**
	 * @return mixed
	 */
	public function getWinner() {
		return $this->winner;
	}

	/**
	 * @param mixed $winner
	 */
	public function setWinner($winner) {
		$this->winner = $winner;
	}
}