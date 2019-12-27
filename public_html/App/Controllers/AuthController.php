<?php
namespace App\Controllers;

use \App\System\View;

class AuthController extends \App\System\Controller
{
    public function loginAction()
    {

        if ($_SESSION['admin'] === 'Y') {
            return View::render('authorized', 'Авторизоваться');
        }
        if (!empty($_POST)) {

            $result = $this->model->login($_POST);

            if ($result) {
                View::message($result);
            }
            View::location('/');
        }

        return View::render('login', 'Авторизоваться');
    }

    public function logoutAction()
    {
        unset($_SESSION['admin']);
        header('location: /');
    }
}