<?php

namespace App;

class TurbineController
{
    protected array $addresses = [];

    public function __construct()
    {
        $this->loadTurbinesData();
    }

    public function getTurbineData(int $id) : string
    {
        $address = $this->addresses[$id];
        return json_encode($address);
    }

    private function loadTurbinesData() : void
    {
        $file = fopen(__DIR__ . '/../turbines.csv', 'r');
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
