<?php namespace Genuineq\User\Classes;

use Log;
use Auth;
use Event;
use Request;
use ApplicationException;
use Genuineq\User\Helpers\RegisterHelper;

/**
 * Register class
 *
 * Contains the logic to validate and register a user based on a received set of data.
 */
class RegisterLogic
{
    /**
     * Register the user.
     * @param  user Contains all the data needed to register a user.
     * @return User
     */
    public static function register($data)
    {
        /** Record IP address */
        if ($ipAddress = Request::ip()) {
            $data['created_ip_address'] = $data['last_ip_address'] = $ipAddress;
        }

        /** Fire event before user registration. */
        Event::fire('genuineq.user.beforeRegister', [&$data]);

        /** Register user. */
        $user = Auth::register($data, /*$activate*/('auto' == RegisterHelper::getActivationMode()), /*$autoLogin*/false);

        /** Fire event after user registration. */
        Event::fire('genuineq.user.register', [$user, post()]);

        return $user;
    }
}
