<?php

namespace App\Lib;


class Config
{
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
        $config = require_once __DIR__ . '/../../config.php';

        return $config[$key] ?? $default;
    }
}
