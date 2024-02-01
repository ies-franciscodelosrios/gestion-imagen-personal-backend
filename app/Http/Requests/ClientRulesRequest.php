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
            'dni' => ['required', new DniValidation()],
            'name' => 'required|min:3|max:50|regex:/^[A-Z]/',
            'surname' => 'required|min:3|max:50|regex:/^[A-Z]/',
            'birth_date' => 'required|date|date_format:Y-m-d',
            'phone' => 'required|numeric|digits:9',
            'email' => ['required', new EmailValidation()],
            'more_info' => 'nullable|string|max:255',
            'life_style' => 'nullable|string|max:255',
            'background_health' => 'nullable|string|max:255',
            'background_aesthetic' => 'nullable|string|max:255',
            'asthetic_routine' => 'nullable|string|max:255',
            'hairdressing_routine' => 'nullable|string|max:255'
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
            'dni.required' => 'DNI is required',
            'name.required' => 'Name is required',
            'name.min' => 'Name minimum lenght is 3 characters',
            'name.max' => 'Name max lenght is 50 characters',
            'surname.required' => 'Surname is required',
            'surname.min' => 'Name minimum lenght is 3 characters',
            'surname.max' => 'Name max lenght is 50 characters',
            'birth_date.required' => 'Birth date is required',
            'birth_date.date' => 'The birth date must be a valid date',
            'birth_date.date_format' => 'The birth date must be in the format Y-m-d',
            'phone.required' => 'Phone is required',
            'phone.numeric' => 'Phone must be a number',
            'phone.digits' => 'Phone must have exactly 9 digits',
            'email.required' => 'Email is required',
            'more_info.max' => 'More info max lenght is 255 characters',
            'life_style.max' => 'Life style max lenght is 255 characters',
            'background_health.max' => 'Background health max lenght is 255 characters',
            'background_aesthetic.max' => 'Background aesthetic max lenght is 255 characters',
            'asthetic_routine.max' => 'Aesthetic routine max lenght is 255 characters',
            'hairdressing_routine.max' => 'Hairdressing routine max lenght is 255 characters',
        ];
    }
}