<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\TurbineAddressController;
use App\Lib\Router;
use App\Lib\App;


App::run();

Router::get('/address/([0-9]*)', function($param) {
    $controller = new TurbineAddressController();
    $return = $controller->getTurbineData($param[0]);
    echo $return;
});

Router::handleNotFound();
