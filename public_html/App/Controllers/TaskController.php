<?php
namespace App\Controllers;

use \App\System\View;

class TaskController extends \App\System\Controller
{
    public function checkAdmin() {
        if ($_SESSION['admin'] !== 'Y') {
            View::message('Требуется авторизация');
        }
    }

    public function listAction($params)
    {
        if (!empty($params[0]) && intval($params[0]) != 0) {
            $page = intval($params[0]);
        } else {
            $page = 1;
        }

        $sort = !empty($_GET['sort']) ? $_GET['sort'] : (!empty($_SESSION['sort']) ? $_SESSION['sort'] : 'id_desc');

        if ($_SESSION['sort'] !== $sort) {
            $_SESSION['sort'] = $sort;
        }
        $result = $this->model->getList($page, $sort);
        $result['isAdmin'] = ($_SESSION['admin'] === 'Y') ? true : false;

        return View::render('task_list', 'Список задач', $result);
    }

    public function addAction()
    {
        if (count($_POST) < 3) {
            View::message('Заполните все поля');
        }

        $result = $this->model->addTask($_POST);

        if ($result) {
            View::message($result);
        }

        View::location('/');
    }

    public function editAction($sort = 'id',$page = 1)
    {
        $this->checkAdmin();

        if (empty($_POST)) {
            View::message('ID не задан');
        }

        $result = $this->model->editTask($_POST);

        if ($result) {
            View::message($result);
        }
    }

    public function doneAction()
    {
        $this->checkAdmin();

        if (empty($_POST)) {
            View::message('ID не задан');
        }

        $result = $this->model->setDone($_POST);

        if ($result) {
            View::message($result);
        }
    }

    public function delAction()
    {
        $this->checkAdmin();

        if (empty($_POST)) {
            View::message('ID не задан');
        }

        $result = $this->model->delTask($_POST);

        if ($result) {
            View::message($result);
        }
    }
}
