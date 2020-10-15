<?php namespace Genuineq\User\Components;

use Log;
use Auth;
use Lang;
use Flash;
use Validator;
use ValidationException;
use ApplicationException;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Genuineq\User\Models\User as UserModel;
use Genuineq\User\Helpers\PluginConfig;
use Genuineq\User\Helpers\PasswordResetHelper;
use Genuineq\User\Helpers\EmailHelper;

/**
 * Password reset workflow
 *
 * When a user has forgotten their password, they are able to reset it using
 * a unique token that, sent to their email address upon request.
 */
class PasswordReset extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'genuineq.user::lang.component.password-reset.name',
            'description' => 'genuineq.user::lang.component.password-reset.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'resetPage' => [
                'title'       => 'genuineq.user::lang.component.password-reset.backend.reset_page',
                'description' => 'genuineq.user::lang.component.password-reset.backend.reset_page_desc',
                'type'        => 'dropdown',
                'default'     => ''
            ],
        ];
    }

    public function getResetPageOptions()
    {
        return [''=>'- refresh page -'] + Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    /**
     * Executed when this component is bound to a page or layout.
     */
    public function onRun()
    {
        /** Check if an password reset code was supplied */
        if ($code = get('reset')) {
            $this->page['resetCode'] = $code;
        }
    }

    /***********************************************
     **************** AJAX handlers ****************
     ***********************************************/

    /**
     * Trigger the password reset email
     */
    public function onPasswordRecover()
    {
        /** Extract the form data. */
        $data = post();

        PasswordResetHelper::validate($data);

        /** Search the user. */
        $user = UserModel::findByEmail(post('email'));

        if ($user) {
            EmailHelper::sendPasswordResetEmail($user, (($this->property('resetPage')) ? ($this->property('resetPage')) : ($this->currentPageUrl())));
        }

        $this->page['message'] = Lang::get('genuineq.user::lang.component.password-reset.message.restore_successful');
        Flash::success(Lang::get('genuineq.user::lang.component.password-reset.message.restore_successful'));
    }

    /**
     * Perform the password reset
     */
    public function onPasswordReset($code = null)
    {
        /** Extract the form data. */
        $data = [
            'code' => post('code'),
            'password' => post('password'),
            'password_confirmation' => post('password_confirmation'),
        ];

        /** Extract the validation rules. */
        $rules = [
            'password' => 'required|between:' . PluginConfig::getMinPasswordLength() . ',' . PluginConfig::getMaxPasswordLength() . '|confirmed',
            'password_confirmation' => 'required|required_with:password',
        ];

        /** Construct the validation error messages. */
        $messages = [
            'password.required' => Lang::get('genuineq.user::lang.component.password-reset.validation.password_required'),
            'password.between' => Lang::get('genuineq.user::lang.component.password-reset.validation.password_between_1') .
                                  PluginConfig::getMinPasswordLength() .
                                  Lang::get('genuineq.user::lang.component.password-reset.validation.password_between_2') .
                                  PluginConfig::getMaxPasswordLength() .
                                  Lang::get('genuineq.user::lang.component.password-reset.validation.password_between_3'),
            'password.confirmed' => Lang::get('genuineq.user::lang.component.password-reset.validation.password_confirmed'),
            'password_confirmation.required' => Lang::get('genuineq.user::lang.component.password-reset.validation.password_confirmation_required'),
            'password_confirmation.required_with' => Lang::get('genuineq.user::lang.component.password-reset.validation.password_confirmation_required_with'),
        ];

        /** Apply the validation rules. */
        $validation = Validator::make($data, $rules, $messages);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        /** Break up the code parts. */
        $parts = explode('!', post('code'));
        if (count($parts) != 2) {
            throw new ApplicationException(Lang::get('genuineq.user::lang.component.password-reset.message.invalid_reset_code'));
        }

        list($userId, $code) = $parts;

        if (!strlen(trim($userId)) || !strlen(trim($code)) || !$code) {
            throw new ApplicationException(Lang::get('genuineq.user::lang.component.password-reset.message.invalid_reset_code'));
        }

        if (!$user = Auth::findUserById($userId)) {
            throw new ApplicationException(Lang::get('genuineq.user::lang.component.password-reset.message.invalid_reset_code'));
        }

        if (!$user->attemptResetPassword($code, post('password'))) {
            throw new ApplicationException(Lang::get('genuineq.user::lang.component.password-reset.message.invalid_reset_code'));
        }

        Flash::success(Lang::get('genuineq.user::lang.component.password-reset.message.reset_successful'));
    }

    /***********************************************
     ******************* Helpers *******************
     ***********************************************/
}
