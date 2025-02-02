<?php

use models\Hotel;
use models\Room;
use repository\HotelRepository;

require_once 'AppController.php';
require_once __DIR__.'/../models/Hotel.php';
require_once __DIR__.'/../models/Room.php';
require_once __DIR__.'/../repository/HotelRepository.php';
class HotelController extends AppController
{
    const MAX_FILE_SIZE = 20*1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = __DIR__ . '/../../public/uploads/';
    private $message = [];

    public function addhotel()
    {
        header('Content-Type: application/json');

        if ($_SERVER['CONTENT_LENGTH'] > self::MAX_FILE_SIZE * 25) {
            http_response_code(413);
            echo json_encode(["status" => "error", "message" => "Request Entity Too Large"]);
            exit;
        }

        $data = [
            "hotel-name" => $_POST["hotel-name"],
            "hotel-description" => $_POST["hotel-description"],
            "hotel-location" => $_POST["hotel-location"],
        ];


        $rooms = json_decode($_POST["rooms"] ?? "[]", true);
        if (!is_array($rooms)) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Invalid room format"]);
            exit;
        }

        $roomsToAdd = [];
        $roomsToAddWhole = [];
        foreach ($rooms as $roomIndex => &$room) {
            $gallery = [];
            foreach ($room['images'] as $imageKey) {
                if (isset($_FILES[$imageKey])) {
                    $file = $_FILES[$imageKey];

                    if ($file['size'] > self::MAX_FILE_SIZE) {
                        http_response_code(400);
                        echo json_encode(["status" => "error", "message" => "File too large: {$file['name']}"]);
                        exit;
                    }
                    if (!in_array($file['type'], self::SUPPORTED_TYPES)) {
                        http_response_code(400);
                        echo json_encode(["status" => "error", "message" => "Invalid file type: {$file['name']}"]);
                        exit;
                    }

                    $uploadPath = self::UPLOAD_DIRECTORY . basename($file['name']);
                    if (!move_uploaded_file($file["tmp_name"], $uploadPath)) {
                        $room['images'][$imageKey] = "Upload failed";
                    } else {
                        $gallery[$imageKey] = basename($file["name"]);
                    }
                }
            }
            $roomObj = new Room($room['name'] ?? "", $room['description'] ?? "", $room['features'] ?? "", $gallery);
            $roomsToAddWhole[$roomIndex] = $roomObj;
            $roomsToAdd[$room['id']] = $roomObj->getRoom();
        }

        if (isset($_FILES["hotel-picture"])) {
            $file = $_FILES["hotel-picture"];

            if ($file['size'] > self::MAX_FILE_SIZE) {
                http_response_code(400);
                echo json_encode(["status" => "error", "message" => "Hotel picture too large"]);
                exit;
            }
            if (!in_array($file['type'], self::SUPPORTED_TYPES)) {
                http_response_code(400);
                echo json_encode(["status" => "error", "message" => "Invalid hotel picture type"]);
                exit;
            }

            $uploadPath = self::UPLOAD_DIRECTORY . basename($file['name']);
            if (move_uploaded_file($file["tmp_name"], $uploadPath)) {
                $data["hotel-picture"] = basename($file["name"]);
            } else {
                $data["hotel-picture"] = "Upload failed";
            }
        } else {
            $data["hotel-picture"] = null;
        }
        $hotel = new Hotel($data['hotel-name'] ?? "", $data['hotel-description'] ?? "", $data['hotel-location'] ?? "", $data['hotel-picture'] ?? "", $roomsToAdd);
        $hotelRepository = new HotelRepository();
        $hotelId = $hotelRepository->insertHotel($hotel);
        foreach ($roomsToAddWhole as $eachRoom) {
            $hotelRepository->insertRoom($hotelId, $eachRoom);
        }
        echo json_encode(["status" => "success", "data" => $hotel->getHotel()]);
        http_response_code(200);
    }

    public function getAllHotelInformation()
    {
        $hotelRepository = new HotelRepository();
        $allHotels = $hotelRepository->getAllHotels();
        $hotels = [];
        foreach ($allHotels as $eachHotel) {
            $hotels[$eachHotel['id']] = [
                'id' => $eachHotel['id'],
                'name' => $eachHotel['name'],
                'description' => $eachHotel['description'],
                'opinion' => $eachHotel['opinion'],
                'location' => $eachHotel['location'],
                'image' => $eachHotel['image'],
            ];
            $rooms = $hotelRepository->getRoomsByHotelId($eachHotel['id']);
            foreach ($rooms as $eachRoom) {
                $hotels[$eachHotel['id']]['rooms'][$eachRoom['id']] = [
                    'id' => $eachRoom['id'],
                    'name' => $eachRoom['name'],
                    'description' => $eachRoom['description'],
                    'features' => $eachRoom['features'],
                    'gallery' => $eachRoom['gallery'],
                ];
            }
        }
        return $hotels;
    }

    public function delhotel($hotelId) {
        $hotelRepository = new HotelRepository();
        $hotelRepository->deleteHotelById($hotelId);
        echo json_encode(["status" => "success"]);
        http_response_code(200);
    }
}