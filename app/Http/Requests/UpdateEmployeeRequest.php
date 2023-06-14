<?php

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
