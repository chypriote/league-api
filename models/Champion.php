<?php

	/**
	* Champion
	*/
	class Champion extends \Illuminate\Database\Eloquent\Model
	{
		protected $fillable = ['name', 'slug', 'games', 'wins', 'bans'];

		protected $attributes = array(
			'games' => 0,
			'wins' => 0,
			'bans' => 0
		);
	}