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

namespace App\Http\Controllers\Web;

/**
 * @uses
 */
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

/**
 * Handle web based employee data requests
 *
 * ToDo: fix up the session flash alert class handling in the views
 */
class EmployeesController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        /** @var Employee $employee */
        return view(
            'admin/employees',
            [
                //'employees' => DB::table('employees')->paginate(10)
                'employees' => Employee::with('company')->paginate(10)
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view(
            'admin/employees-form',
            [
                // we need to provide a companies list
                'companies' => Company::all()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateEmployeeRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateEmployeeRequest $request): Redirector|RedirectResponse
    {
        try {
            $data = $request->validated();

            $employee = new Employee();
            $employee->first_name = $data['first_name'];
            $employee->last_name = $data['last_name'];
            $employee->email = $data['email'];
            $employee->phone = $data['phone'];
        //    $employee->save();
            $employee->company()->associate(Company::find($data['company_id']));
            $employee->save();


            // set message
            Session::flash('status', 'Employee Created Successfully!');
            //Session::flash('alert-class', 'alert-success');

            // return to list
            return redirect('/employees');


        } catch (ValidationException $e) {
            // This should be handled by Laravel
            Session::flash('status', $e->getMessage());
            //Session::flash('alert-class', 'alert-danger');

            // return to form
            return redirect('/employees/create');

        } catch (\Exception $e) {
            // get unhandled exceptions
            Session::flash('status', $e->getMessage());
            //Session::flash('alert-class', 'alert-danger');

            // return to form
            return redirect('/employees/create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function show(int $id): View
    {
        return view('admin/employees-item',
            [
                'employee' => Employee::find($id)
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): View
    {
        return view('admin/employees-form',
            [
                'employee' => Employee::find($id),
                'companies' => Company::all()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateEmployeeRequest  $request
     * @param  int  $id
     * @return Redirector|RedirectResponse
     */
    public function update(UpdateEmployeeRequest $request, int $id): Redirector|RedirectResponse
    {
        try {
            $data = $request->validated();

            // idiot check
            if ($data['id'] == $id) {
                // do update
                $employee = Employee::find($id);
                $employee->first_name = $data['first_name'];
                $employee->last_name = $data['last_name'];
                $employee->email = $data['email'];
                $employee->phone = $data['phone'];
                $employee->save();

                // let update the company if its changed
                if ($employee->company_id != $data['company_id']) {
                    $employee->company()->associate(Company::find($data['company_id']));
                    $employee->save();
                }

                // success
                Session::flash('status', 'Employee entity with ID ' . $id . ' updated successfully!');
                //Session::flash('alert-class', 'alert-success');

                // return to form
                return redirect('/employees/edit/' . $id);
            }

            // set an error message
            Session::flash('status', 'Pre update security check failed!');
            //Session::flash('alert-class', 'alert-danger');

            // return to list
            return redirect('/employees');

        } catch (\Exception $e) {
            // get unhandled exceptions
            Session::flash('status', $e->getMessage());
            //Session::flash('alert-class', 'alert-danger');

            // return to form
            return redirect('/companies/create/' . $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Redirector|RedirectResponse
     */
    public function destroy(int $id): Redirector|RedirectResponse
    {
        try {
            if ($id > 0) {
                Employee::where('id', $id)->delete();

                // set message
                Session::flash('status', 'Employee entity with ID ' . $id. ' deleted successfully!');
                //Session::flash('alert-class', 'alert-success');

                // return to list
                return redirect('/employees');
            }

            // set message
            Session::flash('status', 'Zero (0) is not a valid entity ID');
            //Session::flash('alert-class', 'alert-danger');

            // return to list
            return redirect('/employees');

        } catch(\Exception $e) {
            // get unhandled exceptions
            Session::flash('status', $e->getMessage());
            //Session::flash('alert-class', 'alert-danger');

            // return to edit form
            return redirect('/employees/edit/' . $id);
        }
    }
}
