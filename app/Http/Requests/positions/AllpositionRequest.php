<?php

namespace App\Http\Requests\positions;

use App\Http\Requests\__BaseAPIRequest;
use Illuminate\Http\Request;

class AllpositionRequest extends __BaseAPIRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'last_driver' => 'string|integer',
            'vehicle_id' => 'string|integer',
            'position_name' => 'string',
            'longs' => 'string|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'lats' => 'string|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'dates' => 'date|nullable',
            'odometer' => 'string',
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
            'name.required' => 'Name is required !',
            'name.string' => 'Name must be a string !',
        ];
    }
}
