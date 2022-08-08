<?php

namespace App\Lib;

use App\Exceptions\Handler;
use App\Lib\Config;
use App\Models\Model;
use PDO;


class App
{
    public static function run()
    {
        Handler::setExceptionHandler();
        $db = new PDO(Config::get('database'));
        Model::setUp($db);
    }

}
