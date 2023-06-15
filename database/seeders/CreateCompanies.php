<?php
/*
 * Laravel (R)   Kickstart Project
 * @version      CreateCompanies.php -  001 - 15 6 2023
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

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CreateCompanies extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::insert(
            [
                [
                    'name' => 'Random Company 1',
                    'email' => 'admin@company1.com',
                    'logo' => Str::random(10),
                    'website' => 'http://www.company1.com'
                ],
                [
                    'name' => 'Random Company 2',
                    'email' => 'admin@company2.com',
                    'logo' => Str::random(10),
                    'website' => 'http://www.company2.com'
                ],
                [
                    'name' => 'Random Company 3',
                    'email' => 'admin@company3.com',
                    'logo' => Str::random(10),
                    'website' => 'http://www.company3.com'
                ],
                [
                    'name' => 'Random Company 4',
                    'email' => 'admin@company4.com',
                    'logo' => Str::random(10),
                    'website' => 'http://www.company4.com'
                ],
                [
                    'name' => 'Random Company 5',
                    'email' => 'admin@company5.com',
                    'logo' => Str::random(10),
                    'website' => 'http://www.company5.com'
                ],
                [
                    'name' => 'Random Company 6',
                    'email' => 'admin@company6.com',
                    'logo' => Str::random(10),
                    'website' => 'http://www.company6.com'
                ],
                [
                    'name' => 'Random Company 7',
                    'email' => 'admin@company7.com',
                    'logo' => Str::random(10),
                    'website' => 'http://www.company7.com'
                ],
                [
                    'name' => 'Random Company 8',
                    'email' => 'admin@company8.com',
                    'logo' => Str::random(10),
                    'website' => 'http://www.company8.com'
                ],
                [
                    'name' => 'Random Company 9',
                    'email' => 'admin@company9.com',
                    'logo' => Str::random(10),
                    'website' => 'http://www.company9.com'
                ],
                [
                    'name' => 'Random Company 10',
                    'email' => 'admin@company10.com',
                    'logo' => Str::random(10),
                    'website' => 'http://www.company10.com'
                ]
            ]
        );
    }
}
