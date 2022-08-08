<?php

namespace App\Controllers;

use App\Lib\Request;


class TurbineAddressController
{
    protected array $addresses = [];

    public function __construct()
    {
        $this->loadTurbinesData();
    }

    /**
     * @author Carlos Afonso
     * @date 2022-08-06
     *
     * @param int $id
     *
     * Returns the data from a turbine specified address.
     *
     * @return array
     */
    public function show(Request $request) : array
    {
        $address = $this->addresses[$request->getSegment(0)];
        return $address;
    }

    /**
     * @author Carlos Afonso
     * @date 2022-08-06
     *
     * Load turbines data into $addresses
     */
    private function loadTurbinesData() : void
    {
        $file = fopen(__DIR__ . '/../../turbines.csv', 'r');
        while (($line = fgetcsv($file)) !== FALSE) {
            $this->addresses[] = [
                $line[0],
                $line[1],
                $line[2]
            ];
        }

        fclose($file);
    }

    /**
     * Getter for addresses
     *
     * @return array
     */
    public function getAddresses() : array
    {
        return $this->addresses;
    }

}
