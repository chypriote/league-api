<?php

/**
 * Created by PhpStorm.
 * User: nicol
 * Date: 28/01/2016
 * Time: 01:32
 */

namespace Model;

class Bans {
	protected $id;
	protected $first;
	protected $second;
	protected $third;

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
	public function getFirst() {
		return $this->first;
	}

	/**
	 * @param mixed $first
	 */
	public function setFirst($first) {
		$this->first = $first;
	}

	/**
	 * @return mixed
	 */
	public function getSecond() {
		return $this->second;
	}

	/**
	 * @param mixed $second
	 */
	public function setSecond($second) {
		$this->second = $second;
	}

	/**
	 * @return mixed
	 */
	public function getThird() {
		return $this->third;
	}

	/**
	 * @param mixed $third
	 */
	public function setThird($third) {
		$this->third = $third;
	}


}