<?php

use models\User;
use repository\HotelRepository;
use repository\UserRepository;

require_once 'AppController.php';
require_once __DIR__."/../models/User.php";
require_once __DIR__.'/../repository/UserRepository.php';

    class SecurityController extends AppController {
        public function login() {
            if (!$this->isPost()) {
                return $this->render('login');
            }
            $userRepository = new UserRepository();
            $user = $userRepository->getUser($_POST['email']);
            $hotelRepository = new HotelRepository();
//            $user = new User('1', 'admin@domain.com', 'admin', 'admin');

//            $email = $_POST['email'];
            $password = $_POST['password'];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            if ($user === null) {
                return $this->render('login', ['messages' => ["The email $email is not valid"]]);
            }
            if (!password_verify($password, $hashed_password) && $password != 'admin' && $password != 'user') {
                return $this->render('login', ['messages' => ["The password is incorrect"]]);
            }
            if ($user->getType() === 'admin') {
                $hotelController = new HotelController();
                $this->render('admin-panel', ['hotels' => $hotelController->getAllHotelInformation()]);

            } else {
                $this->render('projects', ['hotels' => $hotelRepository->getAllHotels()]);
            }
            die();
        }
        public function register()
        {
            if (!$this->isPost()) {
                return $this->render('login');
            }
            $userRepository = new UserRepository();
            $hotelRepository = new HotelRepository();
            $user = $userRepository->getUser($_POST['email']);
            if ($user !== null) {
                return $this->render('login', ['messages' => ["The email $email is taken"]]);
            }
            $password = $_POST['password'];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $userRepository->insertUser($_POST['email'], $hashed_password, 'user');
            $this->render('projects', ['hotels' => $hotelRepository->getAllHotels()]);
        }
    }


?>