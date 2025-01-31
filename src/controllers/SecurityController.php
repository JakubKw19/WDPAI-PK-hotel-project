<?php

use models\User;

require_once 'AppController.php';
require_once __DIR__."/../models/User.php";
    class SecurityController extends AppController {
        public function login() {
            $user = new User('admin@domain.com', 'admin');
            if (!$this->isPost()) {
                return $this->render('login');
            }
            $email = $_POST['email'];
            $password = $_POST['password'];
            if ($user->getEmail() !== $email) {
                return $this->render('login', ['messages' => ["The email $email is not valid"]]);
            }
            if ($user->getPassword() !== $password) {
                return $this->render('login', ['messages' => ["The password is incorrect"]]);
            }
            $this->render('projects');
            die();
        }

        // public function register() {
        //     $this->render('register');
        // }

        // public function logout() {
        //     session_start();
        //     session_unset();
        //     session_destroy();
        //     $this->render('login');
        // }
    }


?>