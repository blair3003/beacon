<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseUpdateRequest extends FormRequest
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
            'title' => ['required', Rule::unique('courses')->ignore($this->course)],
            'code' => ['required', Rule::unique('courses')->ignore($this->course)],
            'description' => 'nullable',
            'max_trainees' => 'required',
            'cert_period' => 'required'
        ];
    }
}
