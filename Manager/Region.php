<?php
/**
 * Created by PhpStorm.
 * User: nicol
 * Date: 28/01/2016
 * Time: 04:46
 */

namespace Manager;


class Region implements Manager {
	private $bdd;
	private $table;

	public function     __construct($bdd, $table) {
		$this->_bdd = $bdd;
		$this->_table = $table;
	}

	public function  add($item) {
		// TODO: Implement add() method.
	}

	public function  get($id) {
		// TODO: Implement get() method.
	}

	public function  update($item) {
		// TODO: Implement update() method.
	}

	public function  remove($id) {
		// TODO: Implement remove() method.
	}
}