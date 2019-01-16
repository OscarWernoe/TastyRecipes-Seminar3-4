<?php

class Pages extends CI_Controller {

  public function view($page = 'home') {
    if(!file_exists(APPPATH.'views/'.$page.'.php')) {
      show_404();
    }

    $data = array();

    if(isset($_SESSION['username'])) {
      $data['username'] = $_SESSION['username'];
    }

    $this->load->view('fragments/header');
    $this->load->view($page, $data);
    $this->load->view('fragments/footer');
  }

  public function register() {
    $username_error = ''; $password_error = ''; $confirm_password_error = '';
    $data = array(
      'username' => $this->input->post('username'),
      'password' => $this->input->post('password'),
      'confirm_password' => $this->input->post('confirm_password')
    );

    if(empty(trim($data['username']))) {
      $username_error = "Please enter a username.";
    }

    if(empty(trim($data['password']))) {
      $password_error = "Please enter a password.";
    } else if(strlen(trim($data['password'])) < 6) {
      $password_error = "Password must have at least 6 characters.";
    }

    if(empty(trim($data['confirm_password']))) {
      $confirm_password_error = "Please confirm password.";
    } else{
      if($data['password'] !== $data['confirm_password']) {
        $confirm_password_error = "Password did not match.";
      }
    }

    if(empty($username_error) && empty($password_error) && empty($confirm_password_error)) {
      if($this->user_model->register_user($data['username'], $data['password'])) {
          redirect(base_url('sign_in'), 'location');
      } else {
        $username_error = "This username is already taken.";
        $this->session->set_flashdata($username_error);
      }
    }
    $this->session->set_flashdata('username_error', $username_error);
    $this->session->set_flashdata('password_error', $password_error);
    $this->session->set_flashdata('confirm_password_error', $confirm_password_error);
    redirect($_SERVER['HTTP_REFERER'], 'refresh');
  }

  public function sign_in() {
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    if($this->user_model->get_user($username, $password)) {
      $user_data = array(
        'username' => $username,
        'logged_in' => TRUE
      );
      $this->session->set_userdata($user_data);
      echo json_encode($user_data);

    } else {
      $user_data = array(
        'username' => NULL,
        'logged_in' => FALSE
      );
      echo json_encode($user_data);
    }
  }

  public function sign_out() {
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('logged_in');
    echo json_encode(true);
  }
}