<?php

namespace repository;

use models\Hotel;
use models\Room;
use PDO;
require_once 'Repository.php';
class HotelRepository extends Repository
{
    public function insertHotel(Hotel $hotel) {
        $hotelObj = $hotel->getHotel();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO Hotels (name, description, opinion, location, image)
                VALUES (:name, :description, :opinion, :location, :image) ON CONFLICT DO NOTHING RETURNING id;
        ');
        $str = "4/5";
        $stmt->bindParam(':name', $hotelObj['name'], PDO::PARAM_STR);
        $stmt->bindParam(':description', $hotelObj['description'], PDO::PARAM_STR);
        $stmt->bindParam(':opinion', $str, PDO::PARAM_STR);
        $stmt->bindParam(':location', $hotelObj['location'], PDO::PARAM_STR);
        $stmt->bindParam(':image', $hotelObj['image'], PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function insertRoom($hotelId, Room $room) {
        $roomObj = $room->getRoom();
        $galleryArray = '{' . implode(',', $roomObj['gallery']) . '}';
        $stmt = $this->database->connect()->prepare('
        INSERT INTO Rooms (hotel_id, name, description, features, gallery)
            VALUES (:hotel_id, :name,:description, :features, :gallery) ON CONFLICT DO NOTHING RETURNING hotel_id;
        ');
        $stmt->bindParam(':hotel_id', $hotelId, PDO::PARAM_INT);
        $stmt->bindParam(':name', $roomObj['name'], PDO::PARAM_STR);
        $stmt->bindParam(':description', $roomObj['description'], PDO::PARAM_STR);
        $stmt->bindParam(':features', $roomObj['features'], PDO::PARAM_STR);
        $stmt->bindParam(':gallery', $galleryArray, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getAllHotels() {
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM Hotels;
        ');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getHotelById($id) {
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM Hotels WHERE id = :id;');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getRoomsByHotelId($hotelId) {
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM Rooms WHERE hotel_id = :id;');
        $stmt->bindParam(':id', $hotelId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getRoomById($id)
    {
        $id = (int) $id;
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM Rooms WHERE id = :id;');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function deleteHotelById($id)
    {
        $stmt = $this->database->connect()->prepare('
        DELETE FROM Hotels WHERE id = :id;');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}