<?php

namespace TastyRecipes\View;

use Id1354fw\View\AbstractRequestHandler;
use TastyRecipes\Controller\Controller;
use TastyRecipes\Util\Constants;

class PostComment extends AbstractRequestHandler {
    private $recipe_number;
    private $comment;

    public function setRecipe_Number($recipe_number) {
        $this->recipe_number = $recipe_number;
    }

    public function setComment($comment) {
        $this->comment = $comment;
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
            $result = $contr->postComment($this->recipe_number, $contr->getUsername(), $this->comment);
            $this->addVariable('data', $result);
        } else {
            $this->addVariable('data', false);
        }

        return 'jsonData';
    }
}