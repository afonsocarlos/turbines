<?php

namespace App\Test\Models;

use PHPUnit\Framework\TestCase;
use App\Models\TurbineAddressModel;
use PDO;


class TurbineAddressModelTest extends TestCase
{

    public function testFind()
    {
        $this->assertEquals(
            [
                'id' => 1,
                'turbine_id' => 1,
                'address_id' => 1,
            ],
            TurbineAddressModel::find(1)
        );
    }
}
