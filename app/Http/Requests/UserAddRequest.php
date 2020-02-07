<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class UserAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'address' => 'required|min:3',
            'zipcode' => 'required|min:5|max:5'
        ];
    }
}
