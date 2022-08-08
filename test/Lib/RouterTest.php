<?php

namespace App\Test\Lib;

use PHPUnit\Framework\TestCase;
use App\Exceptions\MethodNotAllowedHttpException;
use App\Exceptions\NotFoundHttpException;
use App\Lib\Router;
use App\Lib\Request;


class RouterTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testGetStringResponse()
    {
        $method = 'GET';
        $this->testStringResponse($method, strtolower($method));
    }

    /**
     * @runInSeparateProcess
     */
    public function testGetJsonResponse()
    {
        $method = 'GET';
        $this->testJsonResponse($method, strtolower($method));
    }

    /**
     * @runInSeparateProcess
     */
    public function testGetWrongHttpMethod()
    {
        $method = 'GET';
        $this->testWrongHttpMethod('POST', strtolower($method));
    }

    /**
     * @runInSeparateProcess
     */
    public function testPostStringResponse()
    {
        $method = 'POST';
        $this->testStringResponse($method, strtolower($method));
    }

    /**
     * @runInSeparateProcess
     */
    public function testPostJsonResponse()
    {
        $method = 'POST';
        $this->testJsonResponse($method, strtolower($method));
    }

    /**
     * @runInSeparateProcess
     */
    public function testPostWrongHttpMethod()
    {
        $method = 'POST';
        $this->testWrongHttpMethod('PUT', strtolower($method));
    }

    /**
     * @runInSeparateProcess
     */
    public function testPutStringResponse()
    {
        $method = 'PUT';
        $this->testStringResponse($method, strtolower($method));
    }

    /**
     * @runInSeparateProcess
     */
    public function testPutJsonResponse()
    {
        $method = 'PUT';
        $this->testJsonResponse($method, strtolower($method));
    }

    /**
     * @runInSeparateProcess
     */
    public function testPutWrongHttpMethod()
    {
        $method = 'PUT';
        $this->testWrongHttpMethod('DELETE', strtolower($method));
    }

    /**
     * @runInSeparateProcess
     */
    public function testDeleteStringResponse()
    {
        $method = 'DELETE';
        $this->testStringResponse($method, strtolower($method));
    }

    /**
     * @runInSeparateProcess
     */
    public function testDeleteJsonResponse()
    {
        $method = 'DELETE';
        $this->testJsonResponse($method, strtolower($method));
    }

    /**
     * @runInSeparateProcess
     */
    public function testDeleteWrongHttpMethod()
    {
        $method = 'DELETE';
        $this->testWrongHttpMethod('GET', strtolower($method));
    }

    private function testStringResponse(string $httpMethod, string $method)
    {
        $_SERVER['REQUEST_METHOD'] = $httpMethod;
        $_SERVER['REQUEST_URI'] = '/address/test';
        $this->expectOutputString('Hello World');
        Router::$method('/address/test', function() {
            return 'Hello World';
        });
    }

    private function testJsonResponse(string $httpMethod, string $method)
    {
        $_SERVER['REQUEST_METHOD'] = $httpMethod;
        $_SERVER['REQUEST_URI'] = '/address/test';
        $response = [
            'status' => 'success',
            'message' => 'Hello World',
        ];

        // Test with array
        $this->expectOutputString('{"status":"success","message":"Hello World"}');
        Router::$method('/address/test', function() use ($response) {
            return $response;
        });

        // clear output buffer
        ob_clean();

        // Test with object
        Router::$method('/address/test', function() use ($response) {
            return (object) $response;
        });
    }

    private function testWrongHttpMethod(string $httpMethod, string $method)
    {
        $_SERVER['REQUEST_METHOD'] = $httpMethod;
        $_SERVER['REQUEST_URI'] = '/address/test';

        $this->expectException(MethodNotAllowedHttpException::class);
        Router::$method('/address/test', function() {
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
        $this->assertEquals(['test', '1'], Router::route('/address/([a-z]*)/([0-9]+)', function(Request $request) {
            return $request->getSegments();
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
