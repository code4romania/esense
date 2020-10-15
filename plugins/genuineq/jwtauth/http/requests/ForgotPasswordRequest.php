<?php

namespace Genuineq\JWTAuth\Http\Requests;

use Genuineq\User\Helpers\PasswordResetHelper;
use Genuineq\JWTAuth\Http\Requests\Request;

class ForgotPasswordRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return PasswordResetHelper::rules();
    }

    /**
     * Get the validation messages of the request.
     *
     * @return array
     */
    public function messages()
    {
        return PasswordResetHelper::messages();
    }
}
