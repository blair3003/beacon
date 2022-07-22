<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VenueStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:venues',
            'email' => 'nullable',
            'tel' => 'nullable',
            'address_1' => 'nullable',
            'address_2' => 'nullable',
            'address_3' => 'nullable',
            'city' => 'nullable',
            'country' => 'nullable',
            'zip' => 'nullable',
            'notes' => 'nullable'
        ];
    }
}
