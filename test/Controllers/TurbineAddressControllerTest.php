<?php

namespace App\Test\Controllers;

use PHPUnit\Framework\TestCase;
use App\Controllers\TurbineAddressController;
use App\Lib\Request;


class TurbineAddressControllerTest extends TestCase
{

    /**
     * @author Carlos Afonso
     * @date 2022-08-06
     *
     * Tests getting turbines data from a csv file.
     */
    public function testGetCorrectTurbineData()
    {
        $request = $this->createMock(Request::class);
        $request->method('getSegment')->willReturn(0);

        $turbineController = new TurbineAddressController();
        $response = $turbineController->show($request);
        $this->assertEquals(["Amaral1-1"," Gamesa"," 39.026628121"], $response);
    }

    /**
     * @author Carlos Afonso
     * @date 2022-08-06
     *
     * Tests getting turbines data from a csv file.
     */
    public function testGetWrongTurbineData()
    {
        $request = $this->createMock(Request::class);
        $request->method('getSegment')->willReturn(0);

        $turbineController = new TurbineAddressController();
        $response = $turbineController->show($request);
        $this->assertNotEquals(["Amaral1-2"," Wrong output"," 3.141592653"], $response);
    }

}
