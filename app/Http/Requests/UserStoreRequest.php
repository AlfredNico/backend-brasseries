<?php

namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Contracts\Validation\Validator;
// use Illuminate\Http\Exceptions\HttpResponseException;
// use Illuminate\Http\Response;

use Illuminate\Foundation\Http\FormRequest;




class UserStoreRequest extends __BaseAPIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

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


    // public function failedValidation(Validator $validator) {
    //     throw new HttpResponseException(response()->json([
    //         'success'   => false,
    //         'message'   => 'Validation errors',
    //         'data'      => $validator->errors()
    //     ], Response::HTTP_NOT_ACCEPTABLE));
    // }

}
