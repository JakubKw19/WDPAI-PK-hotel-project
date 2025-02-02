<?php

use repository\HotelRepository;

require_once 'AppController.php';
require_once __DIR__.'/../repository/HotelRepository.php';

class DefaultController extends AppController {
    public function index() {
        $this->render('login');
    }

    public function projects() {
        $this->render('projects');
    }

    public function gotohotel($id)
    {
        $hotelRepository = new HotelRepository();
        $hotel = $hotelRepository->getHotelById($id);
        $rooms = $hotelRepository->getRoomsByHotelId($id);

        // Pass data to the view
        $this->render('hotel-description', [
            'hotel' => $hotel,
            'rooms' => $rooms,
        ]);
    }

    public function gotoroom($id)
    {
        $hotelRepository = new HotelRepository();
        $this->render('room-details', [
            'room' => $hotelRepository->getRoomById($id),
        ]);

    }
}