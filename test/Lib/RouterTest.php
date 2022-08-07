<?php

namespace App\Test\Lib;

use PHPUnit\Framework\TestCase;
use App\Exceptions\MethodNotAllowedHttpException;
use App\Lib\Router;


class RouterTest extends TestCase
{
    public function testGet()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/address/test';
        $this->assertEquals('Hello World', Router::get('/address/test', function() {
            return 'Hello World';
        }));
    }

    public function testGetWrongHttpMethod()
    {
        $_SERVER['REQUEST_METHOD'] = 'PUT';
        $_SERVER['REQUEST_URI'] = '/address/test';

        $this->expectException(MethodNotAllowedHttpException::class);
        Router::get('/address/test', function() {
            return 'Hello World';
        });
    }

    public function testPost()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/address/test';
        $this->assertEquals('Hello World', Router::post('/address/test', function() {
            return 'Hello World';
        }));
    }

    public function testPostWrongHttpMethod()
    {
        $_SERVER['REQUEST_METHOD'] = 'PUT';
        $_SERVER['REQUEST_URI'] = '/address/test';

        $this->expectException(MethodNotAllowedHttpException::class);
        Router::get('/address/test', function() {
            return 'Hello World';
        });
    }

    public function testRouteReturnsExcpectedResponse()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/address/test';
        $this->assertEquals('Hello World', Router::route('/address/test', function() {
            return 'Hello World';
        }));
    }

    public function testNotExistingRoute()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/address/test';
        $this->assertNull(Router::route('/address/([0-9]+)', function() {
            return 'Hello World';
        }));
    }

    public function testRoutePathParsing()
    {
        $_SERVER['REQUEST_URI'] = '/address/test/1';
        $this->assertEquals(['test', '1'], Router::route('/address/([a-z]*)/([0-9]+)', function($params) {
            return $params;
        }));
    }
}
