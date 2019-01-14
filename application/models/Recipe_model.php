<?php

class Recipe_model extends CI_Model {

  public function get_recipes() {
    return simplexml_load_file(base_url() . '../resources/xml/recipes.xml');
  }
}