<?php

namespace App\Http\Requests\vehicle;

use App\Http\Requests\__BaseAPIRequest;
use Illuminate\Http\Request;

class StoreVehicleRequest extends __BaseAPIRequest
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
            'name' => 'required|string|unique:vehicles',
            'departement_id' => 'numeric|nullable',
            'status_vehicle_id' => 'numeric|nullable',
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
