<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function index() {
        $this->render('login');
    }

    public function projects() {
        $this->render('projects');
    }

    public function gotohotel()
    {
        $this->render('hotel-description');
    }

    public function gotoroom()
    {
        $this->render('room-details');
    }
}