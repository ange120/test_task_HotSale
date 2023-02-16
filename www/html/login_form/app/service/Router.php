<?php

namespace App\service;

use App\controllers\DefaultController;
use App\controllers\BaseInfoController;
use App\controllers\SecurityController;

class Router
{
    public static $routes;

    public static function get($url, $view) {
        self::$routes[$url] = $view;
    }

    public static function post($url, $view)
    {
        self::$routes[$url] = $view;
    }

    public static function run ($url) {

        $classList = [
            'DefaultController' => DefaultController::class,
            'BaseInfoController' => BaseInfoController::class,
            'SecurityController' => SecurityController::class,
        ];

        $action = explode("/", $url)[0];
        if (!array_key_exists($action, self::$routes)) {
            $action = 'errorPage';
        }
        $controller = self::$routes[$action];

        $object = new $classList[$controller]();
        $action = $action ?: 'index';

        $object->$action();
    }
}