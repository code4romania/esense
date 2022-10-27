<?php namespace Genuineq\User\Helpers;

use Auth;
use Lang;
use Flash;
use Redirect;
use Genuineq\User\Helpers\PluginConfig;

class RedirectHelper
{
    /**
     * Redirects the user to the right page when an access denied error occurs.
     * @return Redirect
     */
    private static function getRedirectPage()
    {
        if (Auth::check()) {
            return $redirectPage = trim((string) PluginConfig::getLoginRedirects()[Auth::getUser()->type]);
        } else {
            return $redirectPage = 'authentification/login';
        }
    }

    /**
     * Redirects the user to the right page when an access denied error occurs
     *  and displays the received message.
     * @return Redirect
     */
    public static function redirectWithMessage($message)
    {
        Flash::error($message);

        return $redirectPage = self::getRedirectPage();
    }

    /**
     * Redirects the user to the right page when an access denied error occurs.
     * @return Redirect
     */
    public static function accessDenied()
    {
        Flash::error(Lang::get('genuineq.user::lang.helper.access_denied'));

        return $redirectPage = self::getRedirectPage();
    }
    /**
     * Redirects the user to the right page when an access denied error occurs.
     * @return Redirect
     */
    public static function loginRequired()
    {
        Flash::error(Lang::get('genuineq.user::lang.helper.login_required'));

        return $redirectPage = self::getRedirectPage();
    }
}
