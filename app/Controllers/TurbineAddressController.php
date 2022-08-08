<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Lib\Request;


class TurbineAddressController extends Controller
{
    protected array $addresses = [];

    public function __construct()
    {
        $this->loadTurbinesData();
    }

    /**
     * @author Carlos Afonso
     * @date 2022-08-08
     *
     * Returns the array of turbines data.
     *
     * @return mixed
     */
    public function index(Request $request): mixed
    {
        return null;
    }

    /**
     * @author Carlos Afonso
     * @date 2022-08-06
     *
     * @param Request $request
     *
     * Returns the data from a turbine specified address.
     *
     * @return mixed
     */
    public function show(Request $request) : mixed
    {
        $address = $this->addresses[$request->getSegment(0)];
        return $address;
    }

    /**
     * @author Carlos Afonso
     * @date 2022-08-08
     *
     * @param Request $request
     *
     * Stores a new turbine address.
     *
     * @return mixed
     */
    public function store(Request $request) : mixed
    {
        return null;
    }

    /**
     * @author Carlos Afonso
     * @date 2022-08-08
     *
     * @param Request $request
     *
     * Updates a turbine address.
     *
     * @return mixed
     */
    public function update(Request $request) : mixed
    {
        return null;
    }

    /**
     * @author Carlos Afonso
     * @date 2022-08-08
     *
     * @param Request $request
     *
     * Deletes a turbine address.
     *
     * @return mixed
     */
    public function destroy(Request $request) : mixed
    {
        return null;
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

}
