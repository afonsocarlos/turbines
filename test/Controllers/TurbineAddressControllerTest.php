<?php

namespace App\Test\Controllers;

use PHPUnit\Framework\TestCase;
use App\Controllers\TurbineAddressController;
use App\Lib\Request;
use App\Models\TurbineAddressModel;


class TurbineAddressControllerTest extends TestCase
{

    protected function setUp(): void
    {
        $this->request = $this->createMock(Request::class);
        $this->request->method('getSegment')->willReturn(0);

        $this->model = $this->createMock(TurbineAddressModel::class);
        $this->model->method('find')->willReturn(['name' => 'Amaral1-1', 'description' => 'Gamesa', 'latitude' => '39.026628121', 'longitude' => '-9.048632539']);
    }

    /**
     * @author Carlos Afonso
     * @date 2022-08-06
     *
     * Tests getting turbines data from a csv file.
     */
    public function testShow()
    {
        $turbineController = new TurbineAddressController($this->model);
        $response = $turbineController->show($this->request);
        $this->assertEquals(['name' => 'Amaral1-1', 'description' => 'Gamesa', 'latitude' => '39.026628121', 'longitude' => '-9.048632539'], $response->getBody());
    }

    /**
     * @author Carlos Afonso
     * @date 2022-08-06
     *
     * Tests getting turbines data from a csv file.
     */
    public function testGetWrongTurbineData()
    {
        $turbineController = new TurbineAddressController($this->model);
        $response = $turbineController->show($this->request);
        $this->assertNotEquals(["Amaral1-2"," Wrong output"," 3.141592653"], $response);
    }

}
