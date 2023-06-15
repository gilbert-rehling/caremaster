<?php
/*
 * Laravel (R)   Kickstart Project
 * @version      employeesTest.php -  001 - 15 6 2023
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
 * Seed data is also available for the employees dataset.
 * Run: php artisan storage:link - to enable access to the public images
 */

use App\Models\Employee;
use Tests\Feature\Traits\Authentication;
use Tests\TestCase;

/**
 * Employees tests
 *
 * ToDo: Tried to use a setup() function to trigger user auth but it caused errors - needs investigation
 * ToDo: There is no test for the update action...
 */
class EmployeesTest extends TestCase
{
    use Authentication;

    /** @var int */
    public int $id;

    /**
     * Application loads.
     *
     * @return void
     */
    public function test_uri()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * employees list test.
     *
     * @return void
     */
    public function test_employees_unverified()
    {
        $response = $this->get('/employees');
        // should redirect to the login
        $response->assertStatus(302);
    }

    /**
     * Employees list test with user.
     *
     * @return void
     */
    public function test_employees_verified()
    {
        // fetch authed user
        $this->setupUser();
        $this->authenticated();

        $response = $this->get('/employees');
        // should load
        $response->assertStatus(200);
    }

    /**
     * Employees create form test.
     *
     * @return void
     */
    public function test_employees_create()
    {
        // fetch authed user
        $this->setupUser();
        $this->authenticated();

        $response = $this->get('/employees/create');
        // should load
        $response->assertStatus(200);
    }

    /**
     * Employees save entity test.
     *
     * @return int
     */
    public function test_employees_post()
    {
        // fetch authed user
        $this->setupUser();
        $this->authenticated();

        $firstName = 'Unit';
        $response = $this->post(
            '/employees/create',
            [
                'first_name' => $firstName,
                'last_name' => 'Tester',
                'company_id' => 1, // this makes a broad assumption that some companies exist
                'email' => 'unit-tester@test-company1.com',
                'phone' => '1234555555',
            ]
        );

        // should redirect
        $response->assertStatus(302);

        // get employees to confirm insert
        $employees = Employee::all();
        $inserted = $employees[count($employees)-1];
        $this->assertEquals($firstName, $inserted->first_name);

        // save the id if the last test passes
        if ($inserted->first_name === $firstName) {
            return $inserted->id;
        }
    }

    /**
     * Employees edit form test.
     *
     * @depends test_employees_post
     */
    public function test_employees_edit($id)
    {
        // fetch authed user
        $this->setupUser();
        $this->authenticated();

        $response = $this->get('/employees/edit/' . $id);
        // should load
        $response->assertStatus(200);

        return $id;
    }

    /**
     * Employees delete entity test.
     *
     * @depends test_employees_edit
     */
    public function test_employees_delete($id)
    {
        // fetch authed user
        $this->setupUser();
        $this->authenticated();

        $response = $this->get('/employees/delete/' . $id);
        // should redirect
        $response->assertStatus(302);

        // check item is deleted
        $employee = Employee::find($id);
        self::assertEmpty($employee);
    }
}
