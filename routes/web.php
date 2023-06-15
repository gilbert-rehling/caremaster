<?php
/*
 * Laravel (R)   Kickstart Project
 * @version      web.php -  001 - 15 6 2023
 * @link         https://github.com/gilbert-rehling/caremaster
 * @copyright    Copyright (c) 2023.  Gilbert Rehling. All right reserved. (https://github.com/gilbert-rehling)
 * @license      Released under the MIT model
 * @author       Gilbert Rehling:    gilbert@gilbert-rehling.com
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


/** Employees routes - class ref */
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
    [
        EmployeesController::class, 'index'
    ]
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
    [
        EmployeesController::class, 'create'
    ]
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
    [
        EmployeesController::class, 'store'
    ]
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
    [
    EmployeesController::class, 'show'
    ]
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
    [
    EmployeesController::class, 'edit'
    ]
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
    [
    EmployeesController::class, 'update'
    ]
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
    [
    EmployeesController::class, 'destroy'
    ]
)->name('employee-delete');
