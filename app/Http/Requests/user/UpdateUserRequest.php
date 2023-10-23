<?php

namespace App\Http\Requests\user;

use App\Http\Requests\__BaseAPIRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends __BaseAPIRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // $user_id = $this->user->ids ?? null;

        return [
            'name' => 'string|string|max:50|nullable',
            'username' => 'nullable|unique:users',
            'is_activated' => 'boolean',
            // 'password' => 'required|min:6',
            'dates' => 'date|nullable',
            'cle_user' => 'string|integer',
            'departement_id' => 'numeric|nullable',
            'usertype_id' => 'numeric|nullable',
        ];
    }


    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'username.required' => 'Username is required!',
            'password.required' => 'Password is required!'
        ];
    }
}
