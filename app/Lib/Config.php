<?php

namespace App\Lib;


class Config
{
    private static $config;
    /**
     * @param string $key
     * @param mixed $default
     *
     * Get config from config.php file.
     *
     * @return mixed
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        if (is_null(self::$config)) {
            self::$config = require_once __DIR__ . '/../../config.php';
        }

        return self::$config[$key] ?? $default;
    }
}
