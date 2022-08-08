<?php

namespace App\Controllers;

use App\Lib\Request;
use App\Lib\Response;
use App\Models\TurbineAddressModel;


class TurbineAddressController extends Controller
{
    private TurbineAddressModel $turbineAddressModel;

    public function __construct(TurbineAddressModel $turbineAddressModel = null)
    {
        $this->turbineAddressModel = $turbineAddressModel ?? new TurbineAddressModel();
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
        $addresses = $this->turbineAddressModel->all();
        return Response::toJson($addresses, 200);
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
        $id = $request->getSegment(0);
        $address = $this->turbineAddressModel->find($id);
        if ($address) {
            return Response::toJson($address, 200);
        }
        return Response::toJson(['message' => 'Address not found'], 404);
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
        $data = $request->getParams();
        $address = $this->turbineAddressModel->create($data);
        return Response::toJson($address, 201);
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
        $id = $request->getSegment(0);
        $data = $request->getParams();
        $updated = $this->turbineAddressModel->update($id, $data);
        if ($updated) {
            return Response::toJson(['message' => 'Address updated'], 200);
        }
        return Response::toJson(['message' => 'Address not found'], 404);
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
        $deleted = $this->turbineAddressModel->delete($request->getSegment(0));
        if ($deleted) {
            return Response::toJson(['message' => 'Address deleted'], 200);
        }
        return Response::toJson(['message' => 'Address not found'], 404);
    }

}
