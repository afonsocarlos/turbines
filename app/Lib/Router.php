<?php

namespace App\Lib;

use App\Exceptions\MethodNotAllowedHttpException;

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
            throw new MethodNotAllowedHttpException();
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
            throw new MethodNotAllowedHttpException();
        }

        return $callback();
    }

    /**
     * @author Carlos Afonso
     * @date 2022-08-07
     * @param string $path
     * @param closure $callback
     *
     * Method responsible for handling requests.
     *
     * @return mixed
     */
    public static function route($path, $callback) : mixed
    {
        //
    }
}
