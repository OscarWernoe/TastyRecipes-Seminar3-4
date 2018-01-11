<?php

namespace TastyRecipes\Controller;

use TastyRecipes\Integration\DatabaseHandler;
use TastyRecipes\Integration\XML;
use TastyRecipes\Model\User;

class Controller {
    private $database_handler;
    private $XML;

    private $user;

    public function __construct() {
        $this->database_handler = new DatabaseHandler();
        $this->XML = new XML();
    }

    public function getRecipes() {
        return $this->XML->getRecipes();
    }

    public function getComments($recipe) {
        return $this->database_handler->getComments($recipe);
    }

    public function registerUser($username, $password) {
        return $this->database_handler->addUser($username, $password);
    }

    public function signInUser($username, $password) {
        $result = $this->database_handler->getUser($username, $password);
        if($result) {
            $this->user = new User($result);
            return true;
        } else {
            return false;
        }
    }

    public function isSignedIn() {
        return !is_null($this->user);
    }

    public function getUsername() {
        return $this->user->getUsername();
    }

    public function signOutUser() {
        $this->user = null;
    }

    public function postComment($recipe_number, $username, $comment) {
        return $this->database_handler->addComment($recipe_number, $username, $comment);
    }

    public function deleteComment($comment_id) {
        return $this->database_handler->deleteComment($comment_id);
    }
}