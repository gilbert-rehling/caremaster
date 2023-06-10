<?php

namespace App\Http\Controllers\Api;

/**
 * @uses
 */
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Response;

/**
 * Handle API requests for employee data
 */
class EmployeesController extends Controller
{
    /**
     * Create a new resource in storage.
     *
     * @param CreateEmployeeRequest $request
     * @return Response
     */
    public function create(CreateEmployeeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function read($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateEmployeeRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        //
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id)
    {
        //
    }
}
