<?php

namespace models;

class Hotel
{
    private $name;
    private $description;
    private $location;
    private $image;
    private $rooms;
    public function __construct($name, $description, $location, $image, $rooms)
    {
        $this->name = $name;
        $this->description = $description;
        $this->location = $location;
        $this->image = $image;
        $this->rooms = $rooms;
    }
    public function getName() {
        return $this->name;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getImage() {
        return $this->image;
    }
    public function getRooms() {
        return $this->rooms;
    }

    public function getHotel() {
        $hotel = [];
        $hotel['name'] = $this->name;
        $hotel['description'] = $this->description;
        $hotel['location'] = $this->location;
        $hotel['image'] = $this->image;
        $hotel['rooms'] = $this->rooms;
        return $hotel;
    }
}