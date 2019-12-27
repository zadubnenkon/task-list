<?php

namespace App\Models;

class Auth
{
    public $db;

    public function __construct()
    {
        $this->$db = new \App\System\Db;
    }

    public function login($data)
    {
        // Не стал создавать таблицу с одной записью
        if ($data['login'] === 'admin' && $data['password'] === '123') {

            $_SESSION['admin'] = 'Y';

            return false;

        }
        return 'Совпадений не найдено!';
    }
}