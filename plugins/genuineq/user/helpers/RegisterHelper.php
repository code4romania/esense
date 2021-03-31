<?php namespace Genuineq\User\Helpers;

use Log;
use Lang;
use Event;
use Validator;
use ValidationException;
use Genuineq\User\Helpers\PluginConfig;
use Genuineq\User\Models\Settings as UserSettings;

class RegisterHelper
{
    /**
     * Function that holds the validation rules.
     */
    public static function rules()
    {
        return [
            'surname' => ['required', 'regex:/^[a-zA-Z0123456789 -]*$/i'],
            'name' => ['required', 'regex:/^[a-zA-Z0123456789 -]*$/i'],
            'email' => 'required|between:6,255|email|unique:users',
            'password' => 'required|between:' . PluginConfig::getMinPasswordLength() . ',' . PluginConfig::getMaxPasswordLength() . '|confirmed',
            'password_confirmation' => 'required|required_with:password',
            'consent' => 'required|accepted',
        ];
    }

    /**
     * Function that holds the validation messages.
     */
    public static function messages()
    {
        return [
            'surname.required' => Lang::get('genuineq.user::lang.component.register.validation.name_required'),
            'surname.regex' => Lang::get('genuineq.user::lang.component.register.validation.name_regex'),
            'name.required' => Lang::get('genuineq.user::lang.component.register.validation.name_required'),
            'name.regex' => Lang::get('genuineq.user::lang.component.register.validation.name_regex'),
            'email.required' => Lang::get('genuineq.user::lang.component.register.validation.email_required'),
            'email.between' => Lang::get('genuineq.user::lang.component.register.validation.email_between'),
            'email.email' => Lang::get('genuineq.user::lang.component.register.validation.email_email'),
            'email.unique' => Lang::get('genuineq.user::lang.component.register.validation.email_unique'),
            'password.required' => Lang::get('genuineq.user::lang.component.register.validation.password_required'),
            'password.between' => Lang::get('genuineq.user::lang.component.register.validation.password_between_1') .
                                  PluginConfig::getMinPasswordLength() .
                                  Lang::get('genuineq.user::lang.component.register.validation.password_between_2') .
                                  PluginConfig::getMaxPasswordLength() .
                                  Lang::get('genuineq.user::lang.component.register.validation.password_between_3'),
            'password.confirmed' => Lang::get('genuineq.user::lang.component.register.validation.password_confirmed'),
            'password_confirmation.required' => Lang::get('genuineq.user::lang.component.register.validation.password_confirmation_required'),
            'password_confirmation.required_with' => Lang::get('genuineq.user::lang.component.register.validation.password_confirmation_required_with'),
            'consent.required' => Lang::get('genuineq.user::lang.component.register.validation.consent_required'),
            'consent.accepted' => Lang::get('genuineq.user::lang.component.register.validation.consent_accepted'),
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

        /** Fire event before validate. */
        Event::fire('genuineq.user.beforeValidate', [&$data, &$rules, &$messages, post()]);

        /** Apply the validation rules. */
        $validation = Validator::make($data, $rules, $messages);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }
    }

    /**
     * Get the activation mode from configuration as string
     *
     * @return string
     */
    public static function getActivationMode()
    {
        switch (UserSettings::get('activate_mode')) {
            case UserSettings::ACTIVATE_USER:
                return 'email';
            case UserSettings::ACTIVATE_AUTO:
                return 'auto';
        }

        return 'manual';
    }
}
