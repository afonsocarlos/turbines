<?php

namespace App\Test;

use App\TurbineController;
use PHPUnit\Framework\TestCase;

class TurbineControllerTest extends TestCase
{
    public function testEx()
    {
        $turbineController = new TurbineController();
        $response = $turbineController->ex(0);
        $this->assertEquals('["Amaral1-1"," Gamesa"," 39.026628121"]', $response);
    }
}
