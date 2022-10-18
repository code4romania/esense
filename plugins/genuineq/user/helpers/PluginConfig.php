<?php namespace Genuineq\User\Helpers;

use Config;

class PluginConfig
{
    /**
     * Returns the minimum length for a new password from settings.
     * @return int
     */
    public static function getMinPasswordLength()
    {
        return Config::get('genuineq.user::minPasswordLength', 8);
    }

    /**
     * Returns the maximum length for a new password from settings.
     * @return int
     */
    public static function getMaxPasswordLength()
    {
        return Config::get('genuineq.user::maxPasswordLength', 255);
    }

    /**
     * Returns the configured user types.
     * @return array
     */
    public static function getUserTypes()
    {
        return Config::get(
            'genuineq.user::userTypes',
            [
                'guest',
                'registered',
            ]
        );
    }

    /**
     * Returns the available user type options displayed in the admin view.
     * @return array
     */
    public static function getUserTypeOptions()
    {
        return Config::get(
            'genuineq.user::userTypeOptions',
            [
                'guest' => 'Guest',
                'registered' => 'Registered'
            ]
        );
    }

    /**
     * Returns the configured login redirects.
     * @return array
     */
    public static function getLoginRedirects()
    {

        return Config::get(
            'genuineq.user::loginRedirects',
            [
                'guest' => '/',
                'registered' => '/',
            ]
        );
    }

    /**
     * Returns the configured profile pages.
     * @return array
     */
    public static function getProfilePages()
    {
        return Config::get(
            'genuineq.user::profilePages',
            [
                'guest' => 'profile',
                'registered' => 'profile',
            ]
        );
    }
}
