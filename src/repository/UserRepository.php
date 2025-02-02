<?php

namespace repository;

use models\User;
use PDO;

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM Users WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }
//        return $user['email'];
        return new User(
            $user['id'],
            $user['email'],
            $user['password'],
            $user['type']
        );
    }

    public function insertUser($email, $password, $type)
    {
        $stmt = $this->database->connect()->prepare('
        INSERT INTO Users (email, password, type)
        VALUES (:email, :password, :type)');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->execute();
    }
}