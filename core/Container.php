<?php

namespace Core;

class Container {
    public static function newController($controller) {
        $objController = "App\\Controllers\\" . $controller;
        return new $objController;
    }

    public static function getModel($model) {
        $objModel = "\\App\\Models\\" . $model;
        return new $objModel(Connection::connect());
    }

    public static function pageNotFound() {
        if(file_exists(__DIR__ . "/../app/Views/404.phtml")) {
            return require_once __DIR__ . "/../app/Views/404.phtml";
        } else {
            echo "ERROR 404<br>Page not found!";
        }
    }
}
