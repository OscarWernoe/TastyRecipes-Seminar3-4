<?php

namespace TastyRecipes\View;

use Id1354fw\View\AbstractRequestHandler;
use TastyRecipes\Controller\Controller;
use TastyRecipes\Util\Constants;

class Recipe extends AbstractRequestHandler {
    private $recipe_number;
    private $comment_error;

    public function setRecipe($recipe) {
        $this->recipe_number = $recipe;
    }

    public function setComment_Error($comment_error) {
        $this->comment_error = $comment_error;
    }

    protected function doExecute() {
        try {
            $contr = $this->session->get(Constants::CONTROLLER_NAME);
        } catch(\LogicException $exception) {
            $this->session->restart();
            $contr = new Controller();
            $this->session->set(Constants::CONTROLLER_NAME, $contr);
        }

        $recipes = $contr->getRecipes();

        $this->addVariable('recipe_number', $this->recipe_number);
        $this->addVariable('recipes', $recipes);

        if($contr->isSignedIn()) {
            $this->addVariable(Constants::USERNAME, $contr->getUsername());
        }

        return 'recipe';
    }
}