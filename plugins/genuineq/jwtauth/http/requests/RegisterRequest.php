<?php

namespace Genuineq\JWTAuth\Http\Requests;

use Genuineq\User\Helpers\RegisterHelper;
use Genuineq\JWTAuth\Http\Requests\Request;

class RegisterRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return RegisterHelper::rules();
    }

    /**
     * Get the validation messages of the request.
     *
     * @return array
     */
    public function messages()
    {
        return RegisterHelper::messages();
    }
}
