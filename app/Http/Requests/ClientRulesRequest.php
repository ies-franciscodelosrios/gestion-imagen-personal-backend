<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\EmailValidation;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\DniValidation;

class ClientRulesRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'dni' => ['nullable', new DniValidation()],
            'name' => 'required|min:3|max:50|regex:/^[A-Z]/',
            'surname' => 'required|min:3|max:50|regex:/^[A-Z]/',
            'birth_date' => 'nullable|date|date_format:Y-m-d',
            'phone' => 'nullable|numeric|digits:9',
            'email' => ['nullable', new EmailValidation()],
            'more_info' => 'nullable|string',
            'life_style' => 'nullable|string',
            'background_health' => 'nullable|string',
            'background_aesthetic' => 'nullable|string',
            'asthetic_routine' => 'nullable|string',
            'hairdressing_routine' => 'nullable|string'
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

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.min' => 'Name minimum lenght is 3 characters',
            'name.max' => 'Name max lenght is 50 characters',
            'surname.required' => 'Surname is required',
            'surname.min' => 'Name minimum lenght is 3 characters',
            'surname.max' => 'Name max lenght is 50 characters',
            'birth_date.date' => 'The birth date must be a valid date',
            'birth_date.date_format' => 'The birth date must be in the format Y-m-d',
            'phone.numeric' => 'Phone must be a number',
            'phone.digits' => 'Phone must have exactly 9 digits',
        ];
    }
}