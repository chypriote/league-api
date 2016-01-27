<?php

/**
 * Created by PhpStorm.
 * User: nicol
 * Date: 28/01/2016
 * Time: 00:10
 */

namespace Model;

class Team {
    protected $id;
    protected $region;
    protected $name;
    protected $logo;
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

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getRegion() {
        return $this->region;
    }
    public function setRegion($region) {
        $this->region = $region;
    }
    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function getLogo() {
        return $this->logo;
    }
    public function setLogo($logo) {
        $this->logo = $logo;
    }
    public function getGames() {
        return $this->games;
    }
    public function setGames($games) {
        $this->games = $games;
    }
    public function getWins() {
        return $this->wins;
    }
    public function setWins($wins) {
        $this->wins = $wins;
    }
}