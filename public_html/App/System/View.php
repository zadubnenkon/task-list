<?php

namespace App\System;

class View
{

    public static function render(
        string $path,
        string $title = 'Главная страница',
        array $data =[]
    ) {
        $fullPath = ROOTPATH . '/App/Views/' . $path . '.php';

        if (!file_exists($fullPath)) {
            exit("View doesn't exist");
        }

        if (!empty(data)) {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }

        ob_start();
        include $fullPath;
        $body = ob_get_clean();

        include ROOTPATH . '/App/Views/Layouts/default.php';
    }

    public static function message(string $message)
    {
        exit(json_encode(['message' => $message]));
    }

    public static function location(string $url)
    {
        exit(json_encode(['url' => $url]));
    }
}