<?php

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
