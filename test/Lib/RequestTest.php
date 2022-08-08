<?php

namespace App\Test\Lib;

use PHPUnit\Framework\TestCase;
use App\Lib\Request;


class RequestTest extends TestCase
{
    public function testRequestSegments()
    {
        $request = new Request(params: [1]);
        $this->assertEquals([1], $request->params);
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
}
