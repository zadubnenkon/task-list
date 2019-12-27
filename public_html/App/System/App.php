<?php
namespace App\System;

class App
{

    public static function run()
    {
        $pos = strpos($_SERVER['REQUEST_URI'], '?');
        if ($pos !== false) {
            $path = substr($_SERVER['REQUEST_URI'], 0, $pos);
        } else {
            $path = $_SERVER['REQUEST_URI'];
        }

        $arPath = explode('/', $path);

        array_shift($arPath);
        if ($path === '/') {
            header('location: task/list/');
            return;
        }

        $controller = array_shift($arPath);
        $action = array_shift($arPath);

        $params = $arPath;
        $controllerName = 'App\Controllers\\' . ucfirst($controller) . 'Controller';
        $actionName = $action . 'action';

        if (!class_exists($controllerName)) {
            exit("<h1>Controller doesn't exist</h1>");
        }

        $objConroller = new $controllerName($controller);

        if (!method_exists($objConroller, $actionName)) {
            exit("<h1>Action doesn't exists</h1>");
        }

        $objConroller->$actionName($params);
    }
}
