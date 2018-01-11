<?php

namespace TastyRecipes\View;

use Id1354fw\View\AbstractRequestHandler;
use TastyRecipes\Controller\Controller;
use TastyRecipes\Util\Constants;

class SignIn extends AbstractRequestHandler {
    private $username, $password;
    private $usernameError, $passwordError;

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
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
            $this->usernameError = 'Please enter your username.';
        } else {
            $this->username = trim($this->username);
        }

        if(empty(trim($this->password))) {
            $this->passwordError = 'Please enter your password.';
        } else {
            $this->password = trim($this->password);
        }

        if(empty($this->usernameError) && empty($this->passwordError)) {
            if($contr->signInUser($this->username, $this->password)) {
                $this->username = $contr->getUsername();
                $this->addVariable(Constants::USERNAME, $this->username);
                $this->session->set(Constants::CONTROLLER_NAME, $contr);

                return 'index';
            } else {
                $this->usernameError = $this->passwordError = 'Invalid username or password.';
            }
        }

        $this->addVariable(Constants::USERNAME_ERROR, $this->usernameError);
        $this->addVariable(Constants::PASSWORD_ERROR, $this->passwordError);

        return 'login';
    }
}