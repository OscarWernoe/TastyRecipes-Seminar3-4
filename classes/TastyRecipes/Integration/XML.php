<?php

namespace TastyRecipes\Integration;

use TastyRecipes\Util\Constants;

class XML {
    public function getRecipes() {
        return \simplexml_load_file(Constants::getViewXmlDir() . 'recipes.xml');
    }
}