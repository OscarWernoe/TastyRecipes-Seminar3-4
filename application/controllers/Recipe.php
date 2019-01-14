<?php

class Recipe extends CI_Controller {

  public function view($recipe_number = '') {
    $data['username'] = NULL;

    if(isset($_SESSION['username'])) {
      $data['username'] = $_SESSION['username'];
    }

    if(!isset($recipe_number) || !is_numeric($recipe_number)) {
      show_404();
    }

    $recipe_number = (int) $recipe_number;
    $recipes = $this->recipe_model->get_recipes();
    
    if(empty($recipes->recipe[$recipe_number]) || $recipe_number < 0) {
      show_404();
    }

    $data['recipe_number'] = $recipe_number;
    $data['recipes'] = $recipes;

    //$data['comments'] = $this->comment_model->get_comments($recipe_number + 1);

    $this->load->view('fragments/header');
    $this->load->view('recipe', $data);
    $this->load->view('fragments/footer');
  }

  public function get_comments($recipe_number) {
    $data['comments'] = $this->comment_model->get_comments($recipe_number + 1);
    if($this->session->userdata('logged_in')) {
      $data["username"] = $this->session->userdata('username');
      $data["logged_in"] = TRUE;
    } else {
      $data["username"] = NULL;
      $data["logged_in"] = FALSE;
    }
    echo json_encode($data);
  }

  public function post_comment() {
    $username = $this->session->userdata('username');
    $recipe_number = $this->input->post('recipe_number');
    $comment = htmlspecialchars($this->input->post('comment'));

    $this->comment_model->add_comment($recipe_number + 1, $username, $comment);
    echo json_encode(true);
  }

  public function delete_comment() {
    $comment_id = $this->input->post('comment_id');
    $this->comment_model->delete_comment($comment_id);
    echo json_encode(true);
  }
}