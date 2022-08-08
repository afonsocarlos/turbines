<?php

namespace App\Test\Lib;

use PHPUnit\Framework\TestCase;
use App\Exceptions\MethodNotAllowedHttpException;
use App\Exceptions\NotFoundHttpException;
use App\Lib\Router;


class RouterTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testGetStringResponse()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/address/test';
        $this->expectOutputString('Hello World');
        Router::get('/address/test', function() {
            return 'Hello World';
        });
    }

    /**
     * @runInSeparateProcess
     */
    public function testGetJsonResponse()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/address/test';
        $response = [
            'status' => 'success',
            'message' => 'Hello World',
        ];

        // Test with array
        $this->expectOutputString('{"status":"success","message":"Hello World"}');
        Router::get('/address/test', function() use ($response) {
            return $response;
        });

        // clear output buffer
        ob_clean();

        // Test with object
        Router::get('/address/test', function() use ($response) {
            return (object) $response;
        });
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

    /**
     * @runInSeparateProcess
     */
    public function testPostStringResponse()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/address/test';
        $this->expectOutputString('Hello World');
        Router::post('/address/test', function() {
            return 'Hello World';
        });
    }

    /**
     * @runInSeparateProcess
     */
    public function testPostJsonResponse()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/address/test';
        $response = [
            'status' => 'success',
            'message' => 'Hello World',
        ];

        // Test with array
        $this->expectOutputString('{"status":"success","message":"Hello World"}');
        Router::post('/address/test', function() use ($response) {
            return $response;
        });

        // clear output buffer
        ob_clean();

        // Test with object
        Router::post('/address/test', function() use ($response) {
            return (object) $response;
        });
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

    /**
     * @runInSeparateProcess
     */
    public function testNoRouteFound()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/address/test';
        $this->expectException(NotFoundHttpException::class);
        Router::route('/address/([0-9]+)', function() {
            return 'Hello World';
        });
        Router::handleNotFound();
    }

}
