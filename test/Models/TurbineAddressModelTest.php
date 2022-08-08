<?php

namespace App\Test\Models;

use PHPUnit\Framework\TestCase;
use App\Models\TurbineAddressModel;


class TurbineAddressModelTest extends TestCase
{
    protected function setUp(): void
    {
        $this->db = $this->createMock(\PDO::class);
        $this->stmt = $this->createMock(\PDOStatement::class);
        $this->db->method('query')->willReturn($this->stmt);
        TurbineAddressModel::setUp($this->db);
    }

    /* TODO: This test isn't properly testing the functionality of the model.
     * A better approach would be to set up a sqlite://memory database and test
     * the functionality of the model against that.
     */
    public function testFind()
    {
        $this->db->method('query')->willReturn($this->stmt);
        $this->stmt->method('fetch')->willReturn(['name' => 'Amaral1-1', 'description' => 'Gamesa', 'latitude' => '39.026628121', 'longitude' => '-9.048632539']);
        $this->assertEquals([
            'name' => 'Amaral1-1',
            'description' => 'Gamesa',
            'latitude' => '39.026628121',
            'longitude' => '-9.048632539'
        ], TurbineAddressModel::find(1));
    }

}
