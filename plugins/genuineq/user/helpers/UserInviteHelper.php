<?php namespace Genuineq\User\Helpers;

use Log;
use Auth;
use Genuineq\User\Helpers\RegisterHelper;
use Genuineq\User\Helpers\EmailHelper;
use Genuineq\User\Models\User;

class UserInviteHelper
{
    /**
     * Function that creates a user and sends an invitation email
     *  based on the received data.
     *
     * @return Genuineq\User\Models\User
     */
    public static function inviteUser($user, $data, $url)
    {
        /** Generate a random password. */
        $password = str_random(16);

        $data['password'] = $password;
        $data['password_confirmation'] = $password;
        $data['consent'] = 1;

        /** Validate the data. */
        RegisterHelper::validate($data);

        /** Register new user. */
        $newUser = Auth::register($data, /*$activate*/true, /*$autoLogin*/false);

        EmailHelper::sendInviteEmail($newUser, $user, $url);

        return $newUser;
    }
}
