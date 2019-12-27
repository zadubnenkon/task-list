<?php

namespace App\Models;

class Task
{
    public $db;

    public function __construct()
    {
        $this->$db = new \App\System\Db;
    }

    public function getList(int $page, string $sort)
    {
        $arSort = explode('_', $sort);
        $order = strtoupper($arSort[1]);
        $sort = $arSort[0];

        if (!in_array($sort, ['name', 'email', 'done', 'edited'])) {
            $sort = 'id';
        }
        $sort .= $order == 'ASC' ? ' ASC' : ' DESC';

        $onPageCnt = 3;
        $offset = ($page - 1) * $onPageCnt;

        $totalItems = $this->$db->getList('SELECT COUNT(*) FROM tasks')[0]['COUNT(*)'];

        $result['curPage'] = $page;
        $result['CurSort'] = $sort;
        $result['tasksCount']  = $totalItems;
        $result['totalPages'] = ceil($totalItems / $onPageCnt);
        $result['tasks'] = $this->$db->getList("SELECT * FROM tasks ORDER BY $sort LIMIT $offset, $onPageCnt");

        return $result;
    }

    public function addTask($data)
    {
        foreach ($data as $key => $value) {
            if (trim($value) == '') {
                return 'Пустые значения недопустимы!';
            }
            $params[$key] = htmlspecialchars($value);
        }
        if (strlen($params['text']) > 300) {
            return 'Длина текста задачи не более 300 символов!';
        }
        if (filter_var($params['email'], FILTER_VALIDATE_EMAIL) === false) {
            return 'Введите Корректный email!';
        }
        $this->$db->query('INSERT INTO tasks VALUES (NULL, :name, :email, :text, 0, 0)', $params);

        return false;

    }
    public function editTask($data)
    {
        $params['text'] = trim(htmlspecialchars($data['text']));

        if ($params['text'] == '') {
            return 'Введите текст!';
        }

        if (strlen($params['text']) > 300) {
            return 'Длина текста задачи не более 300 символов!';
        }

        $params['id'] = intval($data['id']);
        if ($params['id'] == 0) {
            return 'Некорректный ID!';
        }

        $this->$db->query("UPDATE tasks SET text = :text, edited = 1 WHERE id = :id", $params);

        return false;

    }

    public function setDone($data)
    {
        $id = intval($data['id']);

        if ($id == 0) {
            return 'Некорректный ID!';
        }

        $this->$db->query("UPDATE tasks SET done = 1 WHERE id = :id", ['id' => $id]);

        return false;

    }

    public function delTask($data)
    {
        $id = intval($data['id']);

        if ($id == 0) {
            return 'Некорректный ID!';
        }

        $this->$db->query("DELETE FROM tasks WHERE id = :id", ['id' => $id]);

        return false;

    }
}