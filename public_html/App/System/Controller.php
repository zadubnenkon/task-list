<?php

namespace App\System;

class Controller
{
    public $name;
    public $model;

    public function __construct($controller)
    {
        $this->name = $controller;
        $this->model = $this->loadModel($controller);
    }

    public function loadModel ($name)
    {
        $class = '\App\Models\\' . ucfirst($name);
        if (class_exists($class)) {
            return new $class;
        }

    }

}