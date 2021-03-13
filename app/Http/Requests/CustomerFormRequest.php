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
            'name' => 'required|string|max:200',
            'mobile_phone' => 'nullable|string|max:200',
            'house_phone' => 'nullable|string|max:200',
            'email' => 'nullable|string|max:200',
            'address' => 'nullable|string|max:200',
            'zip' => 'nullable|string|max:200',
            'city' => 'nullable|string|max:200',
        ];
    }
}
