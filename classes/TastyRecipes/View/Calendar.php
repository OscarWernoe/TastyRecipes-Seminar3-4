<?php
/**
 * Created by IntelliJ IDEA.
 * User: oawer
 * Date: 2017-12-10
 * Time: 18:46
 */

namespace TastyRecipes\View;

use Id1354fw\View\AbstractRequestHandler;
use TastyRecipes\Controller\Controller;
use TastyRecipes\Util\Constants;

class Calendar extends AbstractRequestHandler {
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
        }

        return "calendar";
    }
}