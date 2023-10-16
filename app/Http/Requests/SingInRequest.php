<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class SingInRequest extends __BaseAPIRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'username' => 'required',
            'password' => 'required|string',
            'is_activated' => 'boolean',
        ];
    }


    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages() {
        return [
            'username.required' => 'Username is required!',
            'password.required' => 'Password is required!'
        ];
    }
}
