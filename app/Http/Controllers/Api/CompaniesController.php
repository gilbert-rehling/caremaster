<?php

namespace App\Http\Controllers\Api;

/**
 * @uses
 */
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Http\Response;

/**
 * Handle potential API requests for company data.
 * This class uses terse methods that directly match the intention
 */
class CompaniesController extends Controller
{
    /**
     * Create a new resource in storage.
     *
     * @param  CreateCompanyRequest  $request
     * @return Response
     */
    public function create(CreateCompanyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * This method could return a single entity or all.
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
     * @param  UpdateCompanyRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateCompanyRequest $request, $id)
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
