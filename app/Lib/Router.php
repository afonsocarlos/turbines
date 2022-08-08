<?php

namespace App\Lib;

use App\Exceptions\MethodNotAllowedHttpException;
use App\Exceptions\NotFoundHttpException;
use App\Lib\Request;
use App\Lib\Response;

class Router
{
    private static bool $matchedRoute = false;

    /**
     * @author Carlos Afonso
     * @date 2022-08-06
     * @param string $path
     * @param closure $callback
     *
     * Method responsible for routing GET requests.
     *
     * @return void
     */
    public static function get($path, $callback) : void
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !== 0) {
            throw new MethodNotAllowedHttpException();
        }

        $response = self::route($path, $callback);
        self::response($response);
    }

    /**
     * @author Carlos Afonso
     * @date 2022-08-06
     * @param string $path
     * @param closure $callback
     *
     * Method responsible for routing POST requests.
     *
     * @return void
     */
    public static function post($path, $callback) : void
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0) {
            throw new MethodNotAllowedHttpException();
        }

        $response = self::route($path, $callback);
        self::response($response);
    }

    /**
     * @author Carlos Afonso
     * @date 2022-08-08
     * @param string $path
     * @param closure $callback
     *
     * Method responsible for routing PUT requests.
     *
     * @return void
     */
    public static function put($path, $callback) : void
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'PUT') !== 0) {
            throw new MethodNotAllowedHttpException();
        }

        $response = self::route($path, $callback);
        self::response($response);
    }

    /**
     * @author Carlos Afonso
     * @date 2022-08-08
     * @param string $path
     * @param closure $callback
     *
     * Method responsible for routing DELETE requests.
     *
     * @return void
     */
    public static function delete($path, $callback) : void
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'DELETE') !== 0) {
            throw new MethodNotAllowedHttpException();
        }

        $response = self::route($path, $callback);
        self::response($response);
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
        $params = '/' . trim($_SERVER['REQUEST_URI'], '/');
        $path = str_replace('/', '\/', $path);
        $match = preg_match("/^$path$/", $params, $matches, PREG_OFFSET_CAPTURE);

        if ($match) {
            // first match usually is the route itself
            array_shift($matches);

            // flag that a route has been matched
            self::$matchedRoute = true;

            // get params from the route
            $params = array_map(function($param) {
                return $param[0];
            }, $matches);
            return $callback(new Request($params));
        }

        return null;
    }

    /**
     * @author Carlos Afonso
     * @date 2022-08-07
     * @param array|object|string $response
     *
     * Method responsible for sending the response.
     *
     * @return void
     */
    private static function response($response) : void
    {
        // TODO: pass the status code to the response
        header('Content-Type: application/json');
        if ($response instanceof Response) {
            http_response_code($response->getStatusCode());
            echo json_encode($response->getBody());
        } elseif (is_string($response)) {
            echo $response;
        } elseif (is_array($response) || is_object($response)) {
            echo json_encode($response);
        }
    }

    /**
     * @author Carlos Afonso
     * @date 2022-08-07
     *
     * Method responsible for handling NotFoundHttpException.
     *
     * @return void
     */
    public static function handleNotFound(): void
    {
        if (!self::$matchedRoute) {
            throw new NotFoundHttpException();
        }
    }

}
