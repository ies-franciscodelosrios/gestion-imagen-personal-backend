<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\DniValidation;

class UserRulesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'dni' => ['required', new DniValidation()],
            'name' => 'required|min:3|max:50|regex:/^[A-Z]/',
            'surname' => 'required|min:3|max:50|regex:/^[A-Z]/',
            'email' => 'required|email|max:50',
            'password' => 'required|min:8|max:50',
            'course_year' => 'required|min:1|max:5',
            'cycle' => 'required|integer'
        ];

    }
}