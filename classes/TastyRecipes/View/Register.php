<?php

namespace TastyRecipes\View;

use Id1354fw\View\AbstractRequestHandler;
use TastyRecipes\Controller\Controller;
use TastyRecipes\Util\Constants;

class Register extends AbstractRequestHandler {
    private $username, $password, $confirmPassword;
    private $usernameError, $passwordError, $confirmPasswordError;

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setConfirmPassword($confirmPassword) {
        $this->confirmPassword = $confirmPassword;
    }

    protected function doExecute() {
        try {
            $contr = $this->session->get(Constants::CONTROLLER_NAME);
        } catch(\LogicException $exception) {
            $this->session->restart();
            $contr = new Controller();
            $this->session->set(Constants::CONTROLLER_NAME, $contr);
        }

        if($contr->isSignedIn()) {
            $this->addVariable(Constants::USERNAME, $contr->getUsername());
            return 'index';
        }

        if(empty(trim($this->username))) {
            $this->usernameError = "Please enter a username.";
        }

        if(empty(trim($this->password))) {
            $this->passwordError = "Please enter a password.";
        } else if(strlen(trim($this->password)) < 4) {
            $this->passwordError = "Password must have at least 4 characters.";
        } else {
            $this->password = trim($this->password);
        }

        if(empty(trim($this->confirmPassword))) {
            $this->confirmPasswordError = 'Please confirm password.';
        } else{
            $this->confirmPassword = trim($this->confirmPassword);
            if($this->password != $this->confirmPassword){
                $this->confirmPasswordError = 'Password did not match.';
            }
        }

        if(empty($this->usernameError) && empty($this->passwordError) && empty($this->confirmPasswordError)) {
            if(!$contr->registerUser($this->username, $this->password)) {
                $this->usernameError = "This username is already taken.";
                $this->addVariable(Constants::USERNAME_ERROR, $this->usernameError);
            }

            return 'login';
        } else {
            $this->addVariable(Constants::USERNAME_ERROR, $this->usernameError);
            $this->addVariable(Constants::PASSWORD_ERROR, $this->passwordError);
            $this->addVariable(Constants::CONFIRM_PASSWORD_ERROR, $this->confirmPasswordError);

            return 'register';
        }
    }
}