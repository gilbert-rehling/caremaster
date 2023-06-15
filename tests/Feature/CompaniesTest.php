<?php
/*
 * Laravel (R)   Kickstart Project
 * @version      CompaniesTest.php -  001 - 15 6 2023
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

namespace Tests\Feature;

use App\Events\NewCompanyNotification;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Tests\Feature\Traits\Authentication;
use Tests\TestCase;

class CompaniesTest extends TestCase
{
    use Authentication;

    public $companyId;

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
     * Companies list test.
     *
     * @return void
     */
    public function test_companies_unverified()
    {
        $response = $this->get('/companies');
        // should redirect to the login
        $response->assertStatus(302);
    }

    /**
     * Companies list test with user.
     *
     * @return void
     */
    public function test_companies_verified()
    {
        // fetch authed user
        $this->setupUser();
        $this->authenticated();

        $response = $this->get('/companies');
        // should load
        $response->assertStatus(200);
    }

    /**
     * Companies create form test.
     *
     * @return void
     */
    public function test_companies_create()
    {
        // fetch authed user
        $this->setupUser();
        $this->authenticated();

        $response = $this->get('/companies/create');
        // should load
        $response->assertStatus(200);
    }

    /**
     * Companies save entity test.
     *
     * @return void
     */
    public function test_companies_post()
    {
        // fetch authed user
        $this->setupUser();
        $this->authenticated();

        // prevent the test from trying tio send real main
        Mail::fake();

        // prevent any events from triggering
        Event::fake();

        $name = 'Unit Test Company 1';
        $response = $this->post(
            '/companies/create',
            [
                'name' => $name,
                'email' => 'unit-test@test-company1.com',
                'website' => 'http://unit-test-company1.com',
            ]
        );

        Event::assertDispatched(NewCompanyNotification::class, function ($e) use ($name) {
            return $e->company->name === $name;
        });

        // should redirect
        $response->assertStatus(302);

        // get companies to confirm insert
        $companies = Company::all();
        $inserted = $companies[count($companies)-1];
        $this->assertEquals($name, $inserted->name);

        // save the id if the last test passes
        if ($inserted->name === $name) {
            $this->companyId = $inserted->id;
        }

    //    dd($this->companyId);
    }

    /**
     * Companies edit form test.
     *
     * @return void
     */
    public function test_companies_edit()
    {
        // fetch authed user
        $this->setupUser();
        $this->authenticated();

        dd($this->companyId);

        $response = $this->get('/companies/edit/' . $this->companyId);
        // should load
        $response->assertStatus(200);
    }

    /**
     * Companies delete entity test.
     *
     * @return void
     */
    public function test_companies_delete()
    {
        // fetch authed user
        $this->setupUser();
        $this->authenticated();

        $response = $this->get('/companies/edit/' . $this->companyId);
        // should redirect
        $response->assertStatus(302);

        // check item is deleted
        $company = Company::find($this->companyId);
        self::assertEmpty($company);
    }
}
