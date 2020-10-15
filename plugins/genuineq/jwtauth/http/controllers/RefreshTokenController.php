<?php

namespace Genuineq\JWTAuth\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Genuineq\JWTAuth\Classes\JWTAuth;
use Genuineq\JWTAuth\Http\Requests\TokenRequest;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Genuineq\JWTAuth\Models\Settings;

class RefreshTokenController extends Controller
{
    /**
     * Refresh the user token
     *
     * @param JWTAuth      $auth
     * @param TokenRequest $request
     *
     * @return Illuminate\Http\Response
     */
    public function __invoke(JWTAuth $auth, TokenRequest $request) {
        $token = $request->get('token');
        $auth->setToken($token);

        try {
            if (!$token = $auth->refresh($token)) {
                return response()->json(
                    ['error' => 'could_not_refresh_token'],
                    Response::HTTP_FORBIDDEN
                );
            }
        } catch (TokenBlacklistedException $e) {
            return response()->json(
                ['error' => 'given_token_was_blacklisted'],
                Response::HTTP_FORBIDDEN
            );
        }

        $auth->setToken($token);

        /** Extract the token expiration time and convert it to seconds. */
        $exp = Settings::get('ttl') * 60;

        return response()->json(compact('token', 'exp'));
    }
}
