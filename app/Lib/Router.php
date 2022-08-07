<?php

namespace App\Lib;

class Router
{
    /**
     * @author Carlos Afonso
     * @date 2022-08-06
     * @param string $path
     * @param closure $callback
     *
     * Method responsible for routing GET requests.
     *
     * @return mixed
     */
    public static function get($path, $callback) : mixed
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !== 0) {
            return null;
        }

        return $callback();
    }

    /**
     * @author Carlos Afonso
     * @date 2022-08-06
     * @param string $path
     * @param closure $callback
     *
     * Method responsible for routing POST requests.
     *
     * @return mixed
     */
    public static function post($path, $callback) : mixed
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0) {
            return null;
        }

        return $callback();
    }
}
