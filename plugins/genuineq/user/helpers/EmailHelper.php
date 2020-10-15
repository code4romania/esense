<?php namespace Genuineq\User\Helpers;

use URL;
use Mail;
use Cms\Classes\Page;

class EmailHelper
{
    /**
     * Sends the activation email to a user
     * @param  User $user
     * @return void
     */
    public static function sendActivationEmail($user)
    {
        /** Generate an activation code. */
        $code = implode('!', [$user->id, $user->getActivationCode()]);
        /** Create the activation URL. */
        $link = URL::to('/') . '?activate=' . $code;

        $data = [
            'name' => $user->name,
            'link' => $link
        ];

        Mail::send('genuineq.user::mail.activate', $data, function($message) use ($user) {
            $message->to($user->email, $user->name);
        });
    }

    /**
     * Sends the password reset email to a user
     * @param  User $user
     * @return void
     */
    public static function sendPasswordResetEmail($user, $resetPage)
    {
        /** Generate a password reset code. */
        $code = implode('!', [$user->id, $user->getResetPasswordCode()]);

        /** Create the password reset URL. */
        $link = Page::url($resetPage) . '?reset=' . $code;

        $data = [
            'name' => $user->name,
            'link' => $link
        ];

        Mail::send('genuineq.user::mail.restore', $data, function($message) use ($user) {
            $message->to($user->email, $user->name);
        });
    }

    /**
     * Sends the invite email to a new user.
     * @param  Genuineq\User\Models\User $newUser
     * @param  Genuineq\User\Models\User $user
     * @return void
     */
    public static function sendInviteEmail($newUser, $user, $resetPage)
    {
        /** Generate a password reset code. */
        $code = implode('!', [$user->id, $user->getResetPasswordCode()]);
        /** Create the password reset URL. */
        $link = Page::url($resetPage) . '?reset=' . $code;

        $data = [
            'name' => $newUser->name,
            'link' => $link,
            'user_name' => $user->name,
            'company_name' => $user->profile->name
        ];

        Mail::send('genuineq.user::mail.invite', $data, function($message) use ($newUser) {
            $message->to($newUser->email, $newUser->name);
        });
    }
}
