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

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Feature\Traits\Authentication;
use Tests\TestCase;

class CompaniesTest extends TestCase
{
    use Authentication;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_uri()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Companies test.
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
     * Companies test.
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
     * Companies test.
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
     * Companies test.
     *
     * @return void
     */
    public function test_companies_post()
    {
        // fetch authed user
        $this->setupUser();
        $this->authenticated();

        $response = $this->post(
            '/companies/create',
            [
                'name' => 'Unit Test Company',
                'email' => 'unit-test@test-company.com',
                'phone' => '0444555555'
            ]
        );
        // should load
        $response->assertStatus(200);
    }
}
