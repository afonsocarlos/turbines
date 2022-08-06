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
        $this->assertEquals('Hello World', Router::post('/address', function() {
            return 'Hello World';
        }));
    }
}
