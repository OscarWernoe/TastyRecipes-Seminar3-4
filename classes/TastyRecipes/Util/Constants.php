<?php

namespace TastyRecipes\Util;

use Id1354fw\Util\Classes;

class Constants {
    const DB_HOST = 'localhost';
    const DB_NAME = 'TastyRecipes';
    const DB_USER = 'tasty';
    const DB_PASSWORD = 'recipes';

    const FRAGMENT_DIR = 'resources/fragments';
    const CONTROLLER_NAME = 'contr';
    const USERNAME = 'username';
    const USERNAME_ERROR = 'usernameError';
    const PASSWORD_ERROR = 'passwordError';
    const CONFIRM_PASSWORD_ERROR = 'confirmPasswordError';
    const COMMENT_ERROR = 'comment_error';

    public static function getViewFragmentsDir() {
        return $_SERVER['DOCUMENT_ROOT'] . Classes::getContextPath() . '/resources/fragments/';
    }

    public static function getViewXmlDir() {
        return $_SERVER['DOCUMENT_ROOT'] . Classes::getContextPath() . '/resources/xml/';
    }
}