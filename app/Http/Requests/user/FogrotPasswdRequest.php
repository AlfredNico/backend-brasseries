<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\__BaseAPIRequest;


class FogrotPasswdRequest extends __BaseAPIRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'remember_token' => 'required|string',
            'passwrd' => 'required|string|min:6',
            'c_password' => 'required|required_with:password|same:password|min:6'
        ];
    }


    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages() {
        return [
            'remember_token.required' => 'Username is required!',
            'passwrd.required' => 'Username is required!',
            'c_password.required' => 'Username is required!',
        ];
    }
}
