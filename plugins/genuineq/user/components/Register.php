<?php namespace Genuineq\User\Components;

use Log;
use Lang;
use Auth;
use Event;
use Flash;
use Request;
use Redirect;
use Exception;
use ValidationException;
use ApplicationException;
use Cms\Classes\ComponentBase;
use Genuineq\User\Models\User as UserModel;
use Genuineq\User\Models\Settings as UserSettings;
use Genuineq\User\Classes\RegisterLogic;
use Genuineq\User\Helpers\RegisterHelper;
use Genuineq\User\Helpers\EmailHelper;

/**
 * Register component
 *
 * Allows users to register.
 */
class Register extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'genuineq.user::lang.component.register.name',
            'description' => 'genuineq.user::lang.component.register.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'forceSecure' => [
                'title'       => 'genuineq.user::lang.component.register.backend.force_secure',
                'description' => 'genuineq.user::lang.component.register.backend.force_secure_desc',
                'type'        => 'checkbox',
                'default'     => 0
            ]
        ];
    }

    /**
     * Executed when this component is initialized
     */
    public function prepareVars()
    {
        $this->page['user'] = $this->user();
    }

    /**
     * Executed when this component is bound to a page or layout.
     */
    public function onRun()
    {
        /** Redirect to HTTPS checker */
        if ($redirect = $this->redirectForceSecure()) {
            return $redirect;
        }

        /** Check if an activation code was supplied */
        if ($code = get('activate')) {
            $this->onActivate($code);
        }

        $this->prepareVars();
    }


    /***********************************************
     ****************** Properties *****************
     ***********************************************/

    /**
     * Returns the logged in user, if available
     */
    public function user()
    {
        if (!Auth::check()) {
            return null;
        }

        return Auth::getUser();
    }

    /***********************************************
     **************** AJAX handlers ****************
     ***********************************************/

    /**
     * Register the user
     */
    public function onRegister()
    {
        try {
            if (!UserSettings::get('allow_registration', true)) {
                throw new ApplicationException(Lang::get('genuineq.user::lang.component.register.message.registration_disabled'));
            }

            if (!UserSettings::get('use_register_throttle', false) && UserModel::isRegisterThrottled(Request::ip())) {
                throw new ApplicationException(Lang::get('genuineq.user::lang.component.register.message.registration_throttled'));
            }

            /** Extract the form data. */
            $data = [
                'name' => post('name'),
                'email' => post('email'),
                'password' => post('password'),
                'password_confirmation' => post('password_confirmation'),
                'consent' => ('true' == post('consent')) ? (1) : (0),
            ];

            /** Validate the form data. */
            RegisterHelper::validate($data);

            /** Attempt to register the user. */
            $user = RegisterLogic::register($data);

            if ('email' == RegisterHelper::getActivationMode()) {
                /** Send activation email. */
                EmailHelper::sendActivationEmail($user);
            }

            Flash::success(Lang::get('genuineq.user::lang.component.register.message.activation_email_sent'));
        }
        catch (Exception $ex) {
            if (Request::ajax()){
                throw $ex;
            } else {
                Flash::error($ex->getMessage());
            }
        }
    }

    /**
     * Activate the user
     * @param  string $code The activation code
     */
    public function onActivate($code = null)
    {
        try {
            /** Extract the value of the activation code. */
            $code = post('code', $code);

            $errorFields = ['code' => Lang::get('genuineq.user::lang.component.register.message.invalid_activation_code')];


            /** Break up the code parts */
            $parts = explode('!', $code);
            if (count($parts) != 2) {
                throw new ValidationException($errorFields);
            }

            list($userId, $code) = $parts;

            if (!strlen(trim($userId)) || !strlen(trim($code))) {
                throw new ValidationException($errorFields);
            }

            if (!$user = Auth::findUserById($userId)) {
                throw new ValidationException($errorFields);
            }

            if (!$user->is_activated) {
                if (!$user->attemptActivation($code)) {
                    throw new ValidationException($errorFields);
                }

                Flash::success(Lang::get('genuineq.user::lang.component.register.message.success_activation'));
            } else {
                Flash::success(Lang::get('genuineq.user::lang.component.register.message.already_activated'));
            }
        }
        catch (Exception $ex) {
            if (Request::ajax()) throw $ex;
            else Flash::error($ex->getMessage());
        }
    }

    /***********************************************
     ******************* Helpers *******************
     ***********************************************/

    /**
     * Checks if the force secure property is enabled and if so
     * returns a redirect object.
     * @return mixed
     */
    protected function redirectForceSecure()
    {
        if (
            Request::secure() ||
            Request::ajax() ||
            !$this->property('forceSecure')
        ) {
            return;
        }

        return Redirect::secure(Request::path());
    }
}
