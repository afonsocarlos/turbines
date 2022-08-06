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
    public function testGetTurbinesData()
    {
        $turbineController = new TurbineController();
        $this->assertEquals(5, count($turbineController->getAddresses()));
    }

    public function testEx()
    {
        $turbineController = new TurbineController();
        $response = $turbineController->getTurbineData(0);
        $this->assertEquals('["Amaral1-1"," Gamesa"," 39.026628121"]', $response);
    }

}
