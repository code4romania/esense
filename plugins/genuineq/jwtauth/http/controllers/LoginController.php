<?php

namespace Genuineq\JWTAuth\Http\Controllers;

use Lang;
use Event;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Genuineq\JWTAuth\Classes\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Genuineq\JWTAuth\Http\Requests\LoginRequest;
use Genuineq\User\Helpers\RegisterHelper;
use Genuineq\User\Helpers\EmailHelper;
use Genuineq\JWTAuth\Models\Settings;

class LoginController extends Controller
{
    /**
     * Login the user
     *
     * @param JWTAuth      $auth
     * @param LoginRequest $request
     *
     * @return Illuminate\Http\Response
     */
    public function __invoke(JWTAuth $auth, LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        Event::fire('genuineq.user.beforeAuthenticate', [$this, $credentials]);

        /** Try to authenticare user. */
        try {
            if (!$token = $auth->attempt($credentials)) {
                return response()->json(
                    ['error' => Lang::get('genuineq.user::lang.component.login.message.wrong_credentials'),],
                    Response::HTTP_FORBIDDEN
                );
            }
        } catch (JWTException $e) {
            return response()->json(
                ['error' => Lang::get('genuineq.user::lang.component.login.message.could_not_create_token'),],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        $user = $auth->setToken($token)->authenticate();

        /** Check if the user is banned. */
        if ($user->isBanned()) {
            $auth->invalidate();
            return response()->json(
                ['error' => Lang::get('genuineq.user::lang.component.login.message.banned'),],
                Response::HTTP_FORBIDDEN
            );
        }

        /** Check if the user is NOT activated. */
        if (!$user->is_activated) {
            $auth->invalidate();

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

        /** Extract the token expiration time and convert it to seconds. */
        $exp = Settings::get('ttl') * 60;

        return response()->json(compact('token', 'user', 'exp'));
    }
}
