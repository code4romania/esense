<?php namespace Genuineq\User\Components;

use Log;
use Lang;
use Auth;
use Event;
use Flash;
use Input;
use Request;
use Redirect;
use Exception;
use ApplicationException;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Genuineq\User\Models\Settings as UserSettings;
use Genuineq\User\Helpers\PluginConfig;
use Genuineq\User\Helpers\LoginHelper;
use Genuineq\User\Helpers\EmailHelper;

/**
 * Login component
 *
 * Allows users to login.
 */
class Login extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'genuineq.user::lang.component.login.name',
            'description' => 'genuineq.user::lang.component.login.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'forceSecure' => [
                'title'       => 'genuineq.user::lang.component.login.backend.force_secure',
                'description' => 'genuineq.user::lang.component.login.backend.force_secure_desc',
                'type'        => 'checkbox',
                'default'     => 0
            ],
        ];
    }

    /**
     * Executed when this component is initialized
     */
    public function prepareVars()
    {
        $this->page['user'] = $this->user();
        $this->page['rememberLoginMode'] = $this->rememberLoginMode();
    }

    /**
     * Executed when this component is bound to a page or layout.
     */
    public function onRun()
    {
        /*
         * Redirect to HTTPS checker
         */
        if ($redirect = $this->redirectForceSecure()) {
            return $redirect;
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

    /**
     * Returns the login remember mode.
     */
    public function rememberLoginMode()
    {
        return UserSettings::get('remember_login', UserSettings::REMEMBER_ALWAYS);
    }


    /***********************************************
     **************** AJAX handlers ****************
     ***********************************************/

    /**
     * Handle login requests.
     */
    public function onLogin()
    {
        try {
            /** Extract the post data to validate. */
            $credentials = [
                'email' => post('email'),
                'password' => post('password'),
            ];

            LoginHelper::validate($credentials);

            /** Check the login remember mode */
            switch ($this->rememberLoginMode()) {
                case UserSettings::REMEMBER_ALWAYS:
                    $remember = true;
                    break;
                case UserSettings::REMEMBER_NEVER:
                    $remember = false;
                    break;
                case UserSettings::REMEMBER_ASK:
                    $remember = ('true' == post('remember')) ? (true) : (false);
                    break;
            }

            /** Fire the beforeAuthenticate event. */
            Event::fire('genuineq.user.beforeAuthenticate', [$this, $credentials]);

            /** Authenticate the user. */
            $user = Auth::authenticate($credentials, $remember);

            /** Check if authentication was successful. */
            if (!$user) {
                throw new ApplicationException(Lang::get('genuineq.user::lang.component.login.message.wrong_credentials'));
            }

            /** Fire the afterAuthenticate event. */
            Event::fire('genuineq.user.afterAuthenticate', [$this, $user]);

            /** Check if the user is banned. */
            if ($user->isBanned()) {
                Auth::logout();
                throw new ApplicationException(Lang::get('genuineq.user::lang.component.login.message.banned'));
            }

            /** Check if the user is NOT activated. */
            if (!$user->is_activated) {
                Auth::logout();

                throw new ApplicationException(Lang::get('genuineq.user::lang.component.login.message.not_active'));
            }

            /** Record IP address. */
            if ($ipAddress = Request::ip()) {
                $user->touchIpAddress($ipAddress);
            }

            /** Redirect */
            if ($redirect = $this->loginRedirect($user, true)) {
                return $redirect;
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
     * Redirect to the intended page based on the user type.
     * @param  User $user
     * @return mixed
     */
    protected function loginRedirect($user, $intended = false)
    {
        /** Extract the redirect method. */
        $method = $intended ? 'intended' : 'to';
        /** Extract the login redirect page. */
        $page = trim((string) PluginConfig::getLoginRedirects()[$user->type]);

        /** Refresh page if $page is empty */
        if ('' === $page) {
            return Redirect::refresh();
        }

        $redirectUrl = post('redirect', $this->pageUrl($page)) ;

        return Redirect::$method($redirectUrl);
    }

    /**
     * Checks if the force secure property is enabled and if so
     * returns a redirect object.
     * @return mixed
     */
    protected function redirectForceSecure()
    {
        if (
            !$this->property('forceSecure') ||
            Request::secure() ||
            Request::ajax()
        ) {
            return;
        }

        return Redirect::secure(Request::path());
    }
}
