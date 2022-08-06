<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\TurbineController;


$path = $_SERVER['PATH_INFO'];

if ($path == '/address')
{
    $controller = new TurbineController();
    $return = $controller->getTurbineData($_GET['id']);
    echo $return;
}

