<?php

namespace App\Http\Requests\user;

use App\Http\Requests\__BaseAPIRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreUserRequest extends __BaseAPIRequest
{
    // /**
    //  * Determine if the user is authorized to make this request.
    //  */
    // public function authorize(): bool {
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // $user_id = $this->user->ids ?? null;

        return [
            'name' => 'required|string|max:50',
            'username' => 'required|unique:users',
            'is_activated' => 'boolean',
            'password' => 'required|min:6',
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

        // return [
        //     'name.required' => 'The name field is required.',
        //     'name.string' => 'The name field must be a string.',
        //     'name.max' => 'The name field must not exceed 255 characters.',
        //     'email.required' => 'The email field is required.',
        //     'email.email' => 'Please enter a valid email address.',
        //     'email.unique' => 'The email address is already in use.',
        //     'password.required' => 'The password field is required.',
        //     'password.string' => 'The password field must be a string.',
        //     'password.min' => 'The password must be at least 8 characters long.',
        //     'password.confirmed' => 'The password confirmation does not match.',
        // ];
    }
}
