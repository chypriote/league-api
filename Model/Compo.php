<?php

/**
 * Created by PhpStorm.
 * User: nicol
 * Date: 28/01/2016
 * Time: 01:30
 */

namespace Model;

class Compo {
	protected $id;
	protected $top;
	protected $jungle;
	protected $mid;
	protected $adc;
	protected $support;

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
	public function getTop() {
		return $this->top;
	}

	/**
	 * @param mixed $top
	 */
	public function setTop($top) {
		$this->top = $top;
	}

	/**
	 * @return mixed
	 */
	public function getJungle() {
		return $this->jungle;
	}

	/**
	 * @param mixed $jungle
	 */
	public function setJungle($jungle) {
		$this->jungle = $jungle;
	}

	/**
	 * @return mixed
	 */
	public function getMid() {
		return $this->mid;
	}

	/**
	 * @param mixed $mid
	 */
	public function setMid($mid) {
		$this->mid = $mid;
	}

	/**
	 * @return mixed
	 */
	public function getAdc() {
		return $this->adc;
	}

	/**
	 * @param mixed $adc
	 */
	public function setAdc($adc) {
		$this->adc = $adc;
	}

	/**
	 * @return mixed
	 */
	public function getSupport() {
		return $this->support;
	}

	/**
	 * @param mixed $support
	 */
	public function setSupport($support) {
		$this->support = $support;
	}

}