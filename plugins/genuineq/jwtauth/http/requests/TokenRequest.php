<?php

namespace Genuineq\JWTAuth\Http\Requests;

use Genuineq\JWTAuth\Http\Requests\Request;

class TokenRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => 'required'
        ];
    }

    /**
     * Get the validation messages of the request.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }
}
