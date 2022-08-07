<?php

namespace App\Lib;

use App\Exceptions\Handler;


class App
{
    public static function run()
    {
        Handler::setExceptionHandler();
    }

}
