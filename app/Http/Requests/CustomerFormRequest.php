<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'string|max:100',
            'insertion_name' => 'string|max:100',
            'last_name' => 'string|max:100',
            'company' => 'string|max:100',
            'mobile_phone' => 'string|max:100',
            'house_phone' => 'string|max:100',
            'email' => 'string|max:100',
            'address' => 'string|max:100',
            'zip' => 'string|max:100',
            'city' => 'string|max:100',
        ];
    }
}
