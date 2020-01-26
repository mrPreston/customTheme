<?php
namespace CustomTheme\Model;


class Location {
    public $name;
    public $country;
    public $city;
    public $id;
    public $continent;

    public function __construct($location) {
        $this->name = $location->name;
        $this->country = $location->country;
        $this->city = $location->city;
        $this->id = $location->id;
        $this->continent = $location->continent;
    }
}
