<?php

namespace models;

class User
{
    private $id;
    private $email;
    private $password;
    private $type;
    public function __construct($id, $email, $password, $type)
    {
        $this->id = $id;
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