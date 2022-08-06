<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller;


$path = $_SERVER['PATH_INFO'];

if ($path = '/address')
{
  $controller = new Controller();
  $return = $controller->ex($_GET['id']);
  echo $return;
}

