<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\TurbineAddressController;
use App\Lib\Router;
use App\Lib\App;


App::run();

// -------------------- Turbine Address Routes --------------------
$controller = new TurbineAddressController();
Router::post('/address', [$controller, 'store']);
Router::get('/address', [$controller, 'index']);
Router::get('/address/([0-9]*)', [$controller, 'show']);
Router::put('/address/([0-9]*)', [$controller, 'update']);
Router::delete('/address/([0-9]*)', [$controller, 'destroy']);

Router::handleNotFound();
