<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\__BaseAPIRequest;


class ResetPasswdRequest extends __BaseAPIRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'username' => 'required|string',
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
            'username.string' => 'Password must be a string!'
        ];
    }
}
