<?php

namespace App\Test\Lib;

use PHPUnit\Framework\TestCase;
use App\Lib\Request;


class RequestTest extends TestCase
{
    public function testRequestSegments()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $request = new Request(segments: [1]);
        $this->assertEquals([1], $request->getSegments());
    }

    public function testRequestGetMethod()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $request = new Request();
        $this->assertEquals('GET', $request->getMethod());
    }

    public function testRequestPostMethod()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $request = new Request();
        $this->assertEquals('POST', $request->getMethod());
    }

    public function testRequestGetQueryParams()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET = ['id' => 1, 'name' => 'John'];
        $request = new Request();
        $this->assertEquals(['id' => 1, 'name' => 'John'], $request->getParams());
    }

    public function testRequestPostBodyParams()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = ['id' => 1, 'name' => 'John', 'age' => '30'];
        $request = new Request();
        $this->assertEquals(['id' => 1, 'name' => 'John', 'age' => '30'], $request->getParams());
    }

}
