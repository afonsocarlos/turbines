<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\TurbineAddressController;
use App\Lib\Router;


$path = $_SERVER['PATH_INFO'];

Router::get('/address/([0-9]*)', function($param) {
    $controller = new TurbineAddressController();
    $return = $controller->getTurbineData($param[0]);
    echo $return;
});

Router::handleNotFound();
