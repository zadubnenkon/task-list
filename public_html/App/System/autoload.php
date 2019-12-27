<?php

spl_autoload_register(
    function ($className) {
        $className = ltrim($className, '\\');
        $fileName  = '';
        $namespace = '';

        if ($lastNsPos = strripos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = ROOTPATH.'/'.str_replace('\\', '/', $namespace) . '/';
        }

        $fileName .= str_replace('_', '/', $className) . '.php';

        if (file_exists($fileName)) {
            include $fileName;
        }
    }
);

