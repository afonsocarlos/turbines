<?php

namespace App\Test\Lib;

use PHPUnit\Framework\TestCase;
use App\Lib\Router;


class RouterTest extends TestCase
{
    /**
     * @author Carlos Afonso
     * @date 2022-08-06
     *
     * Test if the router is able to route GET requests.
     */
    public function testGet()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/address/test';
        $this->assertEquals('Hello World', Router::get('/address', function() {
            return 'Hello World';
        }));
    }

    /**
     * @author Carlos Afonso
     * @date 2022-08-06
     *
     * Test if the router is able to route POST requests.
     */
    public function testPost()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/address/test';
        $this->assertEquals('Hello World', Router::post('/address', function() {
            return 'Hello World';
        }));
    }
}
