<?php

namespace TastyRecipes\View;

use Id1354fw\View\AbstractRequestHandler;

class DefaultRequestHandler extends AbstractRequestHandler {
    protected function doExecute() {
        \header('Location: /TastyRecipes/View/FirstPage');
    }
}