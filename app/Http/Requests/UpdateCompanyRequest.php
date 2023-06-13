<?php

namespace App\Http\Requests;

/**
 * @uses
 */
use Illuminate\Foundation\Http\FormRequest;

/**
 * Validation for company updates
 */
class UpdateCompanyRequest extends FormRequest
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
            'id'        => 'required|int',
            'name'      => 'required|string',
            'email'     => 'sometimes|email|nullable',
            'website'   => 'sometimes|string|min:11|max:256|nullable',
            'logo'      => 'sometimes|jpg,jpeg,png,gif,svg|dimension:min_width=100,min_height=100'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'id'        => 'The target item ID was not provided',
            'name'      => 'Please enter a valid company name',
            'email'     => 'Please enter a valid email address',
            'website'   => 'The website address is not valid',
            'logo'      => 'The logo does not meet minimum requirements',
            'name.unique' => 'The  company name provided already exists in the database',
        ];
    }
}
