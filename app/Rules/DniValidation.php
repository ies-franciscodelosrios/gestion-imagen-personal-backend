<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DniValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(preg_match('/^[0-9]{8}[A-Z]$/', $value)) {
            $letter = substr($value, -1);
            $numbers = substr($value, 0, -1);
            if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numbers % 23, 1) == $letter) {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'DNI is invalid.';
    }
}
