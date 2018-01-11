<?php

namespace TastyRecipes\View;

use Id1354fw\View\AbstractRequestHandler;
use TastyRecipes\Controller\Controller;
use TastyRecipes\Util\Constants;

class GetComments extends AbstractRequestHandler {
    private $recipe_number;
    private $comments;

    public function setRecipe_Number($recipe_number) {
        $this->recipe_number = $recipe_number;
    }

    protected function doExecute() {
        try {
            $contr = $this->session->get(Constants::CONTROLLER_NAME);
        } catch(\LogicException $exception) {
            $this->session->restart();
            $contr = new Controller();
            $this->session->set(Constants::CONTROLLER_NAME, $contr);
        }

        $this->comments = $contr->getComments($this->recipe_number + 1);
        $this->addVariable('data', $this->comments);

        return 'jsonData';
    }
}