<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TraineeUpdateRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', Rule::unique('trainees')->ignore($this->trainee)],
            'mobile' => 'nullable',
            'tel' => 'nullable',
            'address_1' => 'nullable',
            'address_2' => 'nullable',
            'address_3' => 'nullable',
            'city' => 'nullable',
            'country' => 'nullable',
            'zip' => 'nullable'
        ];
    }
}
