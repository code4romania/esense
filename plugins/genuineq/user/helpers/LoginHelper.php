<?php namespace Genuineq\User\Helpers;

use Lang;
use Flash;
use Validator;
use ValidationException;
use Genuineq\User\Helpers\PluginConfig;

class LoginHelper
{
    /**
     * Function that holds the validation rules.
     */
    public static function rules()
    {
        return [
            'email' => 'required|email|between:6,255',
            'password' => 'required|between:' . PluginConfig::getMinPasswordLength() . ',' . PluginConfig::getMaxPasswordLength(),
        ];
    }

    /**
     * Function that holds the validation messages.
     */
    public static function messages()
    {
        return [
            'email.required' => Lang::get('genuineq.user::lang.component.login.validation.email_required'),
            'email.between' => Lang::get('genuineq.user::lang.component.login.validation.email_between'),
            'email.email' => Lang::get('genuineq.user::lang.component.login.validation.email_email'),
            'password.required' => Lang::get('genuineq.user::lang.component.login.validation.password_required'),
            'password.between' => Lang::get('genuineq.user::lang.component.login.validation.password_between_1') .
                                  PluginConfig::getMinPasswordLength() .
                                  Lang::get('genuineq.user::lang.component.login.validation.password_between_2') .
                                  PluginConfig::getMaxPasswordLength() .
                                  Lang::get('genuineq.user::lang.component.login.validation.password_between_3'),
        ];
    }

    /**
     * Validates the login credentials.
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
