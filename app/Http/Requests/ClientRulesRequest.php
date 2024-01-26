<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\DniValidation;

class ClientRulesRequest extends FormRequest
{
    public function rules(): array
    {
        return[
            'dni' => ['required', new DniValidation()],
            'name' => 'required|min:3|max:50|regex:/^[A-Z]/',
            'surname' => 'required|min:3|max:50|regex:/^[A-Z]/',
            'birth_date' => 'required|date|date_format:Y-m-d',
            'phone' => 'required|numeric|digits:9',
            'email' => 'required|email|max:50',
            'more_info' => 'required|string|max:255', 
            'life_style' => 'nullable|string|max:255',
            'background_health' => 'nullable|string|max:255',
            'background_aesthetic' => 'nullable|string|max:255',
            'asthetic_routine' => 'nullable|string|max:255',
            'hairdressing_routine' => 'nullable|string|max:255',    
        ];
        
        
    }
}