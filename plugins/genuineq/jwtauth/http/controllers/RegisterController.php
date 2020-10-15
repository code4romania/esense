<?php

namespace Genuineq\JWTAuth\Http\Controllers;

use Lang;
use Illuminate\Http\Response;
use Genuineq\JWTAuth\Models\User as UserModel;
use Illuminate\Routing\Controller;
use Genuineq\JWTAuth\Classes\JWTAuth;
use Genuineq\JWTAuth\Models\Settings;
use Genuineq\JWTAuth\Http\Requests\RegisterRequest;
use Genuineq\JWTAuth\Http\Controllers\Traits\CanMakeUrl;
use Genuineq\User\Models\Settings as UserSettings;
use Genuineq\JWTAuth\Http\Controllers\Traits\CanSendMail;
use Genuineq\User\Classes\RegisterLogic;
use Genuineq\User\Helpers\RegisterHelper;
use Genuineq\User\Helpers\EmailHelper;

class RegisterController extends Controller
{
    use CanMakeUrl;
    use CanSendMail;

    /**
     * Register the user
     *
     * @param JWTAuth         $auth
     * @param RegisterRequest $request
     *
     * @return Illuminate\Http\Response
     */
    public function __invoke(JWTAuth $auth, RegisterRequest $request)
    {
        if (!UserSettings::get('allow_registration', true)) {
            return response()->json(
                ['error' => Lang::get('genuineq.user::lang.component.register.message.registration_disabled'),],
                Response::HTTP_FORBIDDEN
            );
        }

        if (!UserSettings::get('use_register_throttle', false) && UserModel::isRegisterThrottled($request->ip())) {
            return response()->json(
                ['error' => Lang::get('genuineq.user::lang.component.register.message.registration_throttled'),],
                Response::HTTP_FORBIDDEN
            );
        }

        $data = $request->all();

        try {
            /** Attempt to register the user. */
            $user = RegisterLogic::register($data);
        } catch (Exception $exception) {
            return response()->json(
                ['error' => $exception->getMessage(),],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        if ('email' == RegisterHelper::getActivationMode()) {
            /** Send activation email. */
            EmailHelper::sendActivationEmail($user);

            return response()->json(
                ['message' => Lang::get('genuineq.user::lang.component.register.message.activation_email_sent'),],
                Response::HTTP_CREATED
            );
        }

        return response()->json(
            ['message' => Lang::get('genuineq.user::lang.component.register.message.registration_successful'),],
            Response::HTTP_CREATED
        );
    }
}
