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
            'remember_tkn' => 'required|string',
            'passwd' => 'required|string|min:6|required_with:c_passwd|same:c_passwd',
            'c_passwd' => 'min:6'
            // 'passwd' => 'required|string|min:6',
            // 'c_passwd' => 'required|required_with:password|same:password|min:6'
        ];
    }


    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages() {
        return [
            'remember_tkn.required' => 'Rember token is required!',
            'passwd.required' => 'Password is required!',
            'c_passwd.required' => 'Password confirmation is required!',
            'passwd.same' => 'Password confirmation is required!',
            // 'c_passwd.same' => 'The password confirmation does not match !',
        ];
    }
}
