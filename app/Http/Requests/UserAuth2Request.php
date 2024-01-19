<?php

namespace App\Http\Requests;

class UserAuth2Request extends UserRulesRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $rol = $this->user('api')->rol;
        return $rol === 0 || $rol === 1 || $rol === 2;
    }
}
