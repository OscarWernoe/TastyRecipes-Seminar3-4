<?php

namespace TastyRecipes\View;

use Id1354fw\View\AbstractRequestHandler;
use TastyRecipes\Controller\Controller;
use TastyRecipes\Util\Constants;

class DeleteComment extends AbstractRequestHandler {
    private $comment_id;

    public function setComment_Id($comment_id) {
        $this->comment_id = $comment_id;
    }

    protected function doExecute() {
        try {
            $contr = $this->session->get(Constants::CONTROLLER_NAME);
        } catch(\LogicException $exception) {
            $this->session->restart();
            $contr = new Controller();
            $this->session->set(Constants::CONTROLLER_NAME, $contr);
        }

        if($contr->isSignedIn() && $contr->deleteComment($this->comment_id)) {
            $this->addVariable('data', $this->comment_id);
        } else {
            $this->addVariable('data', false);
        }

        return 'jsonData';
    }
}