<?php

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\CompaniesController;
use App\Http\Controllers\Web\EmployeesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Public routes
 */
Route::get('/', function () {
    return view('/public/welcome');
});

/**
 * Auth routes
 */
Auth::routes();

/**
 * Routes that requires a logged-in user
 */
Route::get(
    '/home',
    [
        HomeController::class, 'index'
    ]
)->name('home');

/** Companies routes - class ref */
/*
|------------------------------------------
| Get companies
|------------------------------------------
| URL:          /companies
| Controller:   Web\CompaniesController@index
| Method:       GET
| Description:  Gets all company entities from database
*/
Route::get(
    '/companies',
    [
        CompaniesController::class, 'index'
    ]
)->name('companies');

/*
|------------------------------------------
| Create company
|------------------------------------------
| URL:          /companies/create
| Controller:   Web\CompaniesController@create
| Method:       GET
| Description:  Loads the form to create a new company
*/
Route::get(
    '/companies/create',
    [
        CompaniesController::class, 'create'
    ]
)->name('company-create');

/*
|------------------------------------------
| Store company
|------------------------------------------
| URL:          /companies/create
| Controller:   Web\CompaniesController@store
| Method:       POST
| Description:  Stores (saves) a new company entity in the database
*/
Route::post(
    '/companies/create',
    [
        CompaniesController::class, 'store'
    ]
)->name('company-store');

/*
|------------------------------------------
| Show company
|------------------------------------------
| URL:          /companies/{id}
| Controller:   Web\CompaniesController@show
| Method:       GET
| Description:  Display a company entity
*/
Route::get(
    '/companies/{id}',
    [
        CompaniesController::class, 'show'
    ]
)->name('company-show');

/*
|------------------------------------------
| Edit company
|------------------------------------------
| URL:          /companies/edit/{id}
| Controller:   Web\CompaniesController@edit
| Method:       GET
| Description:  Display a company entity for editing
*/
Route::get(
    '/companies/edit/{id}',
    [
        CompaniesController::class, 'edit'
    ]
)->name('company-edit');

/*
|------------------------------------------
| Update company
|------------------------------------------
| URL:          /companies/edit/{id}
| Controller:   Web\CompaniesController@update
| Method:       POST
| Description:  Updates a company entity in the database
*/
Route::post(
    '/companies/edit/{id}',
    [
        CompaniesController::class, 'update'
    ]
)->name('company-update');

/*
|------------------------------------------
| Delete company
|------------------------------------------
| URL:          /companies/delete/{id}
| Controller:   Web\CompaniesController@destroy
| Method:       GET
| Description:  Destroy (delete) a company entity from the database
*/
Route::get('/companies/delete/{id}', [
    CompaniesController::class, 'destroy'
])->name('company-delete');


/** Employees - Shorthand */
/*
|------------------------------------------
| Get employees
|------------------------------------------
| URL:          /employees
| Controller:   Web\EmployeesController@index
| Method:       GET
| Description:  Gets all employee entities from database
*/
Route::get(
    '/employees',
    'EmployeesController@index'
)->name('employees');

/*
|------------------------------------------
| Create employee
|------------------------------------------
| URL:          /employees/create
| Controller:   Web\EmployeesController@create
| Method:       GET
| Description:  Loads the form to create a new employee
*/
Route::get(
    '/employees/create',
    'EmployeesController@create'
)->name('employee-create');

/*
|------------------------------------------
| Store employee
|------------------------------------------
| URL:          /employees/create
| Controller:   Web\EmployeesController@store
| Method:       GET
| Description:  Store a new employee entity in the database
*/
Route::post(
    '/employees/create',
    'EmployeesController@store'
)->name('employee-store');

/*
|------------------------------------------
| Show employee
|------------------------------------------
| URL:          /employees/{id}
| Controller:   Web\EmployeesController@show
| Method:       GET
| Description:  Display an employee entity
*/
Route::get(
    '/employees/{id}',
    'EmployeesController@show'
)->name('employee-show');

/*
|------------------------------------------
| Edit employee
|------------------------------------------
| URL:          /employees/edit/{id}
| Controller:   Web\EmployeesController@edit
| Method:       GET
| Description:  Display an employee entity for editing
*/
Route::get(
    '/employees/edit/{id}',
    'EmployeesController@edit'
)->name('employee-edit');

/*
|------------------------------------------
| Update employee
|------------------------------------------
| URL:          /employees/edit/{id}
| Controller:   Web\EmployeesController@update
| Method:       POST
| Description:  Update an employee entity in the database
*/
Route::post(
    '/employees/edit/{id}',
    'EmployeesController@update'
)->name('employee-update');

/*
|------------------------------------------
| Delete employee
|------------------------------------------
| URL:          /employees/delete/{id}
| Controller:   Web\EmployeesController@destroy
| Method:       GET
| Description:  Destroy (delete) an employee entity from the database
*/
Route::get(
    '/employees/delete/{id}',
    'EmployeesController@destroy'
)->name('employee-delete');
