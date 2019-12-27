<?php

namespace App\System;

class Db
{

    public $pdo;

    public function __construct()
    {

        $settings = $this->getPDOSettings();
        $this->pdo = new \PDO($settings['dsn'], $settings['user'], $settings['pass'], null);

    }

    protected function getPDOSettings()
    {

        $config = include ROOTPATH.'/App/Config/Db.php';

        $result['dsn'] = "{$config['type']}:host={$config['host']};"
                        . "dbname={$config['dbname']};charset={$config['charset']}";

        $result['user'] = $config['user'];
        $result['pass'] = $config['pass'];
        return $result;
    }

    public function getList($query, array $params=null)
    {

        $stmt = $this->query($query, $params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function query($query, array $params=null)
    {

        if (is_null($params)) {
            $stmt = $this->pdo->query($query);
            return $stmt;
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt;

    }
}