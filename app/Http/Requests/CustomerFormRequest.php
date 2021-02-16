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
            'name' => 'nullable|string|max:100',
            'mobile_phone' => 'nullable|string|max:100',
            'house_phone' => 'nullable|string|max:100',
            'email' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:100',
            'zip' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
        ];
    }
}
