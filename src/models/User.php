<?php

namespace models;

class User
{
    private $email;
    private $password;
    private $type;
    public function __construct($email, $password, $type)
    {
        $this->email = $email;
        $this->password = $password;
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getType() {
        return $this->type;
    }
}