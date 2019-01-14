<?php

class User_model extends CI_Model {
  public function register_user($username, $password) {
    if($this->username_exists($username)) {
      $data = array(
        'username' => $username,
        'password' => password_hash($password, PASSWORD_DEFAULT)
      );

      return $this->db->insert('users', $data);
    }

    return false;
  }

  public function username_exists($username) {
    $query = $this->db->get_where('users', array('username' => $username));
    if(empty($query->row_array())) { return true; }
    else { return false; }
  }

  public function get_user($username, $password) {
    $this->db->where('username', $username);
    $query = $this->db->get('users');
    $query->num_rows();
    if(password_verify($password, $query->row(0)->password)) {
      $this->db->where('username', $username);
      $this->db->where('password', $query->row(0)->password);
      $result = $this->db->get('users');
      if($result->num_rows() === 1) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
}