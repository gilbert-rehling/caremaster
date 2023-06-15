<?php
/*
 * Laravel (R)   Kickstart Project
 * @version      UpdateEmployeeRequest.php -  001 - 15 6 2023
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

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Provide the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id'            => 'required|integer',
            'first_name'    => 'required|string|min:2|max:150',
            'last_name'     => 'required|string|min:2|max:150',
            'company_id'    => 'required|integer',
            'email'         => 'sometimes|email:rfc|nullable',
            'phone'         => 'sometimes|string|min:6|max:13|nullable',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'id'            => 'Entity ID was not provided',
            'first_name'    => 'Please enter a first name',
            'last_name'     => 'Please enter a last name',
            'company_id'    => 'A company was not selected correctly',
            'email'         => 'Please enter a valid email address',
            'phone'         => 'Please enter a valid phone number',
        ];
    }
}
