<?php

namespace Genuineq\JWTAuth\Http\Controllers;

use Lang;
use Mail;
use Illuminate\Http\Response;
use Genuineq\JWTAuth\Models\User;
use Genuineq\JWTAuth\Models\Settings;
use Illuminate\Routing\Controller;
use Genuineq\JWTAuth\Http\Requests\ForgotPasswordRequest;
use Genuineq\JWTAuth\Http\Controllers\Traits\CanMakeUrl;
use Genuineq\JWTAuth\Http\Controllers\Traits\CanSendMail;
use Genuineq\User\Helpers\PasswordResetHelper;
use Genuineq\User\Helpers\EmailHelper;
use Genuineq\User\Helpers\RegisterHelper;

class ForgotPasswordController extends Controller
{
    use CanMakeUrl,
        CanSendMail;

    /**
     * Send the forgot password request
     *
     * @param ForgotPasswordRequest $request
     *
     * @return Illuminate\Http\Response
     */
    public function __invoke(ForgotPasswordRequest $request) {
        /** Extract the form data. */
        $data = $request->all();

        PasswordResetHelper::validate($data);

        /** Search the user. */
        $user = User::findByEmail($request->get('email'));

        /** Check if the user exists. */
        if ($user) {
            /** Check if the user is banned. */
            if ($user->isBanned()) {
                return response()->json(
                    ['error' => Lang::get('genuineq.user::lang.component.login.message.banned'),],
                    Response::HTTP_FORBIDDEN
                );
            }

            /** Check if the user is NOT activated. */
            if (!$user->is_activated) {
                if ('email' == RegisterHelper::getActivationMode()) {
                    /** Send activation email. */
                    EmailHelper::sendActivationEmail($user);

                    return response()->json(
                        ['error' => Lang::get('genuineq.user::lang.component.login.message.not_active_email_sent'),],
                        Response::HTTP_FORBIDDEN
                    );
                }

                return response()->json(
                    ['error' => Lang::get('genuineq.user::lang.component.login.message.not_active'),],
                    Response::HTTP_FORBIDDEN
                );
            }

            EmailHelper::sendPasswordResetEmail($user, Settings::get('reset_password_page'));
        }

        return response()->json(
            ['message' => Lang::get('genuineq.user::lang.component.password-reset.message.restore_successful'),]
        );
    }
}
