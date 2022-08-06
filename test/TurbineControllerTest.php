<?php

namespace App\Test;

use App\TurbineController;
use PHPUnit\Framework\TestCase;

class TurbineControllerTest extends TestCase
{
    /**
     * @author Carlos Afonso
     * @date 2022-08-06
     *
     * Tests getting turbines data from a csv file.
     */
    public function testLoadTurbinesData()
    {
        $turbineController = new TurbineController();
        $this->assertEquals(5, count($turbineController->getAddresses()));
    }

    /**
     * @author Carlos Afonso
     * @date 2022-08-06
     *
     * Tests getting turbines data from a csv file.
     */
    public function testGetCorrectTurbineData()
    {
        $turbineController = new TurbineController();
        $response = $turbineController->getTurbineData(0);
        $this->assertEquals('["Amaral1-1"," Gamesa"," 39.026628121"]', $response);
    }

    /**
     * @author Carlos Afonso
     * @date 2022-08-06
     *
     * Tests getting turbines data from a csv file.
     */
    public function testGetWrongTurbineData()
    {
        $turbineController = new TurbineController();
        $response = $turbineController->getTurbineData(0);
        $this->assertNotEquals('["Amaral1-2"," Wrong output"," 3.141592653"]', $response);
    }

}
