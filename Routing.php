<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/HotelController.php';

class Routing {
    public static $routes;

    public static function get($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function post($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function run($url) {
        $segments = explode("/", trim($url, "/"));
        $action = $segments[0] ?: 'login';
        $id = isset($segments[1]) ? $segments[1] : null;

        if (!array_key_exists($action, self::$routes)) {
            die('Wrong URL!');
        }

        $controller = self::$routes[$action];
        $object = new $controller;

        if ($id) {
            $object->$action($id);
        } else {
            $object->$action();
        }
    }

}