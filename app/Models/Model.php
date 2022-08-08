<?php

namespace App\Models;

use App\Interfaces\ModelInterface;
use PDO;


abstract class Model implements ModelInterface
{
    protected static PDO $db;

    /**
     * @param $db
     */
    public static function setUp($db)
    {
        self::$db = $db;
    }

}
