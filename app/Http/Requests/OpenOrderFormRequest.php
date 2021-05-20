<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OpenOrderFormRequest extends FormRequest
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
            'handed' => 'nullable|string|max:2000',
            'description' => 'nullable|string|max:2000',
            'problem' => 'nullable|string|max:2000',
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
