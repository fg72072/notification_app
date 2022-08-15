<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|max:150',
            'role' => 'required|numeric|min:0|max:1',
            'status' => 'required|numeric|min:0|max:1',
            'email' => 'required|max:150|unique:users',
            'password' => 'required|min:8|max:20|confirmed',
        ];
    }
}
