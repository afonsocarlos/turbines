<?php

namespace App\Test;

use App\Controller;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    public function testEx()
    {
        $_SERVER['PATH_INFO'] = '/address';
        $_GET['id'] = 0;
        $controller = new Controller();
        $response = $controller->ex();
        $this->assertEquals('["Amaral1-1"," Gamesa"," 39.026628121"]', $response);
    }
}
