<?php

namespace App\Http\Requests;

class ClientAuthRequest extends ClientRulesRequest
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
