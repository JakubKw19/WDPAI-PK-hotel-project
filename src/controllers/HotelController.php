<?php

require_once 'AppController.php';
class HotelController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = __DIR__ . '/../../public/uploads/';
    private $message = [];

    public function addhotel()
    {

        header('Content-Type: application/json');

        $data = [
            "hotel-name" => $_POST["hotel-name"],
            "hotel-description" => $_POST["hotel-description"],
            "hotel-location" => $_POST["hotel-location"],
        ];

        $rooms = json_decode($_POST["rooms"], true);

        foreach ($rooms as $roomIndex => &$room) {
            foreach ($room['images'] as $imageKey) {
                if (isset($_FILES[$imageKey])) {
                    $file = $_FILES[$imageKey];
                    $uploadPath = self::UPLOAD_DIRECTORY . $file['name'];
                    if (!move_uploaded_file($file["tmp_name"], $uploadPath)) {
                        $room['images'][$imageKey] = "Upload failed";
//                        $room['images'][$imageKey] = "/uploads/" . basename($file["name"]);
                    }
                }
            }
        }
        $data['rooms'] = $rooms;
        if (isset($_FILES["hotel-picture"])) {
            $file = $_FILES["hotel-picture"];
            $uploadPath = self::UPLOAD_DIRECTORY.$_FILES['hotel-picture']['name'];

            if (move_uploaded_file($file["tmp_name"], $uploadPath)) {
                $data["hotel-picture"] = basename($file["name"]);
            } else {
                $data["hotel-picture"] = "Upload failed";
            }
        }

        echo json_encode(["status" => "success", "data" => $data]);
        http_response_code(200);
    }

}