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

Route::get('/', function () {
    return view('/public/welcome');
});

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

/* Companies - Longhand */
Route::get('/companies', [
    CompaniesController::class, 'index'
])->name('companies');

Route::post('/companies/create', [
    CompaniesController::class, 'create'
])->name('company-create');

Route::get('/companies/read/{id?}', [
    CompaniesController::class, 'read'
])->name('company-edit');

Route::post('/companies/update/{id}', [
    CompaniesController::class, 'update'
])->name('company-update');

Route::get('/companies/delete/{id}', [
    CompaniesController::class, 'delete'
])->name('company-delete');

/* Employees - Shorthand */
Route::get(
    '/companies',
    'EmployeesController@index'
)->name('companies');

Route::post(
    '/companies/create',
    'EmployeesController@create'
)->name('company-create');

Route::get(
    '/companies/read/{id?}',
    'EmployeesController@read'
)->name('company-edit');

Route::post(
    '/companies/update/{id}',
    'EmployeesController@update'
)->name('company-update');

Route::get(
    '/companies/delete/{id}',
    'EmployeesController@delete'
)->name('company-delete');
