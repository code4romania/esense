<?php namespace Genuineq\User\Helpers;

use Lang;
use Validator;
use ValidationException;
use Genuineq\User\Helpers\PluginConfig;

class PasswordResetHelper
{
    /**
     * Function that holds the validation rules.
     */
    public static function rules()
    {
        return [
            'email' => 'required|email|between:6,255',
        ];
    }

    /**
     * Function that holds the validation messages.
     */
    public static function messages()
    {
        return [
            'email.required' => Lang::get('genuineq.user::lang.component.password-reset.validation.email_required'),
            'email.between' => Lang::get('genuineq.user::lang.component.password-reset.validation.email_between'),
            'email.email' => Lang::get('genuineq.user::lang.component.password-reset.validation.email_email'),
        ];
    }

    /**
     * Validates the signup data.
     * @return Redirect
     */
    public static function validate($data)
    {
        /** Extract the validation rules and error messages. */
        $rules = self::rules();
        $messages = self::messages();

        /** Apply the validation rules. */
        $validation = Validator::make($data, $rules, $messages);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }
    }
}
