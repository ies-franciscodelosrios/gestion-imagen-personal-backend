<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
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
            'name' => 'required|min:3|max:50|regex:/^[A-Za-z\s]/',
            'surname' => 'required|min:3|max:50|regex:/^[A-Za-z\s]/',
            'email' => 'required|email|max:50',
            'password' => 'min:4|max:50',
            'course_year' => 'required|min:1|max:5',
            'cycle' => 'required|integer'
        ];
    }

    /**
     * Throw exception if request is failed.
     *
     * @param  Validator  $validator
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors(),
        ], 400));
    }
}
