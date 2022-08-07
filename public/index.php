<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\TurbineController;
use App\Lib\Router;


$path = $_SERVER['PATH_INFO'];

Router::get('/address/([0-9]*)', function($param) {
    $controller = new TurbineController();
    $return = $controller->getTurbineData($param[0]);
    echo $return;
});
