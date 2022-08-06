<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\TurbineController;


$path = $_SERVER['PATH_INFO'];

if ($path = '/address')
{
  $controller = new TurbineController();
  $return = $controller->ex($_GET['id']);
  echo $return;
}

