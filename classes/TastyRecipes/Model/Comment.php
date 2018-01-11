<?php

namespace TastyRecipes\Model;

class Comment implements \JsonSerializable {
    private $id;
    private $username;
    private $recipe;
    private $comment;

    public function __construct($id, $user, $recipe, $comment) {
        $this->id = $id;
        $this->username = $user;
        $this->recipe = $recipe;
        $this->comment = $comment;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getRecipe() {
        return $this->recipe;
    }

    public function getComment() {
        return $this->comment;
    }

    public function jsonSerialize() {
        $json_obj = new \stdClass();
        $json_obj->id = $this->id;
        $json_obj->username = $this->username;
        $json_obj->recipe = $this->recipe;
        $json_obj->comment = $this->comment;

        return $json_obj;
    }
}