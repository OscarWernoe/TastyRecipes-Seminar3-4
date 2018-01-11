<?php

namespace TastyRecipes\Model;

class User {
    private $username;

    public function __construct($username) {
        $this->username = $username;
    }

    public function getUsername() {
        return $this->username;
    }
}