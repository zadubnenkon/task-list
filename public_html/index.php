<?php
define('ROOTPATH', __DIR__);
require_once ROOTPATH . '/App/System/autoload.php';

session_start();

App\System\App::run();