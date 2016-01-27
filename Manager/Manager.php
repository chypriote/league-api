<?php

/**
 * Created by PhpStorm.
 * User: nicol
 * Date: 28/01/2016
 * Time: 01:41
 */

namespace Manager;

interface Manager {
	public function	add($item);
	public function	get($id);
	public function	update($item);
	public function	remove($id);
}