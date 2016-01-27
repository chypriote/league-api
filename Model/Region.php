<?php

/**
 * Created by PhpStorm.
 * User: nicol
 * Date: 28/01/2016
 * Time: 01:28
 */

namespace Model;

class Region {
	protected $id;
	protected $name;
	protected $country;

	public function __construct(array $data) {
		foreach ($data as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
	}
	public function getCountry() {
		return $this->country;
	}
	public function setCountry($country) {
		$this->country = $country;
	}
}