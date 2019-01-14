<?php

class Comment_model extends CI_Model {
  public function get_comments($recipe) {
    $query = "SELECT comment_id, username, comment FROM comments JOIN users ON comments.user_id = users.user_id WHERE recipe_id = ? ORDER BY comment_id";
    $query = $this->db->query($query, array($recipe));
    return $query->result();
  }

  public function add_comment($recipe_id, $username, $comment) {
    $this->db->where('username', $username);
    $query = $this->db->get('users');
    $query->num_rows();
    $user_id = $query->row(0)->user_id;
    
    $data = array(
      'recipe_id' => $recipe_id,
      'user_id' => $user_id,
      'comment' => $comment
    );

    return $this->db->insert('comments', $data);
  }

  public function delete_comment($comment_id) {
    $query = "DELETE FROM comments WHERE comment_id = ?";
    $query = $this->db->query($query, array($comment_id));
  }
}