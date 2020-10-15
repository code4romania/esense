<?php namespace Genuineq\User\Components;

use Log;
use Lang;
use Auth;
use Mail;
use Hash;
use Event;
use Flash;
use Input;
use Request;
use Redirect;
use Validator;
use Exception;
use ValidationException;
use ApplicationException;
use \System\Models\File;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Genuineq\User\Models\User as UserModel;
use Genuineq\User\Models\Settings as UserSettings;
use Genuineq\User\Helpers\RedirectHelper;
use Genuineq\User\Helpers\RegisterHelper;
use Genuineq\User\Helpers\EmailHelper;
use Genuineq\User\Helpers\PluginConfig;

/**
 * Account component
 *
 * Allows users to update and deactivate their account.
 */
class Account extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'genuineq.user::lang.component.account.name',
            'description' => 'genuineq.user::lang.component.account.description'
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
    }

    /***********************************************
     **************** AJAX handlers ****************
     ***********************************************/

    /**
     * Updates the user avatar.
     */
    public function onAvatarUpdate()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the user */
        $user = Auth::getUser();

        if (Input::hasFile('avatar')) {
            $user->avatar = Input::file('avatar');
            $user->save();

            Flash::success(Lang::get('genuineq.user::lang.component.account.message.avatar_update_successful'));
            return Redirect::refresh();
        }

        Flash::error(Lang::get('genuineq.user::lang.component.account.message.avatar_update_failed'));
    }

    /**
     * Updates the user email
     */
    public function onEmailUpdate()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the form data. */
        $data = post();

        /** Extract the validation rules. */
        $rules = [
            'accountEmail' => 'required|between:6,255|email|unique:users,email',
        ];

        /** Construct the validation error messages. */
        $messages = [
            'accountEmail.required' => Lang::get('genuineq.user::lang.component.account.validation.account_mail_required'),
            'accountEmail.between' => Lang::get('genuineq.user::lang.component.account.validation.account_mail_between'),
            'accountEmail.email' => Lang::get('genuineq.user::lang.component.account.validation.account_mail_email'),
            'accountEmail.unique' => Lang::get('genuineq.user::lang.component.account.validation.account_mail_unique'),
        ];

        /** Apply the validation rules. */
        $validation = Validator::make($data, $rules, $messages);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        /** Extract the user */
        $user = Auth::getUser();

        /** Update the enmail */
        $user->email = $data['accountEmail'];
        $user->save();

        Flash::success(Lang::get('genuineq.user::lang.component.account.message.email_update_successful'));
    }

    /**
     * Updates the user password
     */
    public function onPasswordUpdate()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the user */
        $user = Auth::getUser();

        if (!post('current_password')) {
            throw new ValidationException(['current_password' => Lang::get('genuineq.user::lang.component.account.validation.current_password_required')]);
        } elseif (!$user->checkHashValue('password', post('current_password'))) {
            throw new ValidationException(['current_password' => Lang::get('genuineq.user::lang.component.account.validation.current_password_wrong')]);
        }

        /** Extract the form data. */
        $data = post();

        /** Extract the validation rules. */
        $rules = [
            'password' => 'required|between:' . PluginConfig::getMinPasswordLength() . ',' . PluginConfig::getMaxPasswordLength() . '|confirmed',
            'password_confirmation' => 'required|required_with:password',
        ];

        /** Construct the validation error messages. */
        $messages = [
            'password.required' => Lang::get('genuineq.user::lang.component.account.validation.password_required'),
            'password.between' => Lang::get('genuineq.user::lang.component.account.validation.password_between_1') .
                                  PluginConfig::getMinPasswordLength() .
                                  Lang::get('genuineq.user::lang.component.account.validation.password_between_2') .
                                  PluginConfig::getMaxPasswordLength() .
                                  Lang::get('genuineq.user::lang.component.account.validation.password_between_3'),
            'password.confirmed' => Lang::get('genuineq.user::lang.component.account.validation.password_confirmed'),
            'password_confirmation.required' => Lang::get('genuineq.user::lang.component.account.validation.password_confirmation_required'),
            'password_confirmation.required_with' => Lang::get('genuineq.user::lang.component.account.validation.password_confirmation_required_with'),
        ];

        /** Apply the validation rules. */
        $validation = Validator::make($data, $rules, $messages);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        /** Extract the user. */
        $user = Auth::getUser();

        /** Update the password. */
        $user->password = $data['password'];
        $user->forceSave();

        /** Password has changed, reauthenticate the user. */
        Auth::login($user->reload(), true);

        Flash::success(Lang::get('genuineq.user::lang.component.account.message.password_update_successful'));
    }

    /**
     * Updated email notifications flag.
     */
    public function onEmailNotificationsUpdate()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the user */
        $user = Auth::getUser();

        /** Update the email notifications */
        $user->email_notifications = post('emailNotifications');
        $user->save();

        Flash::success(Lang::get('genuineq.user::lang.component.account.message.email_notifications_update_successful'));
    }

    /**
     * Update user email and notifications.
     */
    public function onUserAccountUpdate()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the user */
        $user = Auth::getUser();

        /** Check if email is different. */
        if (post('email') !== $user->email) {
            $data = [
                'email' => post('email')
            ];

            /** Extract the validation rules. */
            $rules = [
                'email' => 'required|between:6,255|email|unique:users,email',
            ];

            /** Construct the validation error messages. */
            $messages = [
                'email.required' => Lang::get('genuineq.user::lang.component.account.validation.account_mail_required'),
                'email.between' => Lang::get('genuineq.user::lang.component.account.validation.account_mail_between'),
                'email.email' => Lang::get('genuineq.user::lang.component.account.validation.account_mail_email'),
                'email.unique' => Lang::get('genuineq.user::lang.component.account.validation.account_mail_unique'),
            ];

            /** Apply the validation rules. */
            $validation = Validator::make($data, $rules, $messages);
            if ($validation->fails()) {
                throw new ValidationException($validation);
            }

            /** Update the user */
            $user->email = $data['email'];
        }

        /** Update user notifications flag. */
        $user->email_notifications = (post('email_notifications')) ? (1) : (0);
        $user->save();

        Flash::success(Lang::get('genuineq.user::lang.component.account.message.account_update_successful'));
    }

    /**
     * Function that sends an invitation to a new user.
     */
    public function onUserInvite()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the user */
        $user = Auth::getUser();

        /** Generate a random password. */
        $password = str_random(16);

        /** Extract the form data. */
        $data = [
            'name' => post('name'),
            'email' => post('email'),
            'password' => $password,
            'password_confirmation' => $password,
            'type' => 'company',
            'consent' => 1
        ];

        /** Validate the data. */
        RegisterHelper::validate($data);

        /** Register new user. */
        $newUser = Auth::register($data, /*$activate*/true, /*$autoLogin*/false);

        /** Set the user profile. */
        $newUser->profile_id = $user->profile_id;
        $newUser->profile_type = $user->profile_type;
        $newUser->save();

        EmailHelper::sendInviteEmail($newUser, $user, (($this->property('resetPage')) ? ($this->property('resetPage')) : ($this->currentPageUrl())));

        Flash::success(Lang::get('genuineq.user::lang.component.account.message.user_invite_successful'));

        return Redirect::refresh();
    }

    /**
     * Deactivate user
     */
    public function onDeactivate()
    {
        if (!$user = $this->user()) {
            return;
        }

        if (!$user->checkHashValue('password', post('password'))) {
            throw new ValidationException(['password' => Lang::get('genuineq.user::lang.account.invalid_deactivation_pass')]);
        }

        Auth::logout();
        $user->delete();

        Flash::success(post('flash', Lang::get(/*Successfully deactivated your account. Sorry to see you go!*/'genuineq.user::lang.account.success_deactivation')));

        /*
         * Redirect
         */
        if ($redirect = $this->makeRedirection()) {
            return $redirect;
        }
    }

    /***********************************************
     ******************* Helpers *******************
     ***********************************************/

    /**
     * Redirect to the intended page after successful update, sign in or registration.
     * The URL can come from the "redirect" property or the "redirect" postback value.
     * @return mixed
     */
    protected function makeRedirection($intended = false)
    {
        $method = $intended ? 'intended' : 'to';

        $property = trim((string) $this->property('redirect'));

        // No redirect
        if ($property === '0') {
            return;
        }
        // Refresh page
        if ($property === '') {
            return Redirect::refresh();
        }

        $redirectUrl = $this->pageUrl($property) ?: $property;

        if ($redirectUrl = post('redirect', $redirectUrl)) {
            return Redirect::$method($redirectUrl);
        }
    }
}
