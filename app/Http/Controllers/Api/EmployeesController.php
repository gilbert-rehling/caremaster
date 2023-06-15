<?php
/*
 * Laravel (R)   Kickstart Project
 * @version      EmployeesController.php -  001 - 15 6 2023
 * @link         https://github.com/gilbert-rehling/caremaster
 * @copyright    Copyright (c) 2023.  Gilbert Rehling. All right reserved. (www.gilbert-rehling.com)
 * @license      Released under the MIT model
 * @author       Gilbert Rehling:    gilbert@gilbertrehling.com
 * This kickstart project provides basic authentication along with modeling for 2 data sets with a foreign key example
 * Created using Laravel 9.* on PHP 8.0.
 * To get started download and extract the package to your desired location.
 * Run: composer install.
 * Create an appropriate database. MySQL was used for this project.
 * Create and populate the .env file
 * Run: php artisan migrate
 * To seed the admin user run: php artisan db:seed --class=CreateUser
 * Seed data is also available for the Companies dataset.
 * Run: php artisan storage:link - to enable access to the public images
 */

namespace App\Http\Controllers\Api;

/**
 * @uses
 */
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Response;

/**
 * Handle potential API requests for employee data.
 * This class uses terse methods that directly match the intention
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
