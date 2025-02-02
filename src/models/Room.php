<?php

namespace models;

class Room
{
    private $name;
    private $description;
    private $features;
    private $gallery;
    public function __construct($name, $description, $features, $gallery)
    {
        $this->name = $name;
        $this->description = $description;
        $this->features = $features;
        $this->gallery = $gallery;
    }
    public function getRoom() {
        $room = [];
        $room['name'] = $this->name;
        $room['description'] = $this->description;
        $room['features'] = $this->features;
        $room['gallery'] = $this->gallery;
        return $room;
    }
}