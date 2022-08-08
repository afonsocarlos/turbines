<?php

namespace App\Lib;

use App\Exceptions\Handler;
use App\Models\Model;
use PDO;


class App
{
    public static function run()
    {
        Handler::setExceptionHandler();
        Model::setUp(new PDO('sqlite:turbine.sqlite3'));
    }

}
