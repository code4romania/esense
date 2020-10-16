<?php

namespace Genuineq\JWTAuth\Http\Requests;

use Genuineq\User\Helpers\LoginHelper;
use Genuineq\JWTAuth\Http\Requests\Request;

class LoginRequest extends Request
{

    /**
     * Get credentials from request
     *
     * @return array
     */
    public function getCredentials()
    {
        return [
            'email' => $this->get('email'),
            'password' => $this->get('password')
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return LoginHelper::rules();
    }

    /**
     * Get the validation messages of the request.
     *
     * @return array
     */
    public function messages()
    {
        return LoginHelper::messages();
    }
}
