<?php

Route::group(
    [
        'prefix' => 'api/auth',
        'namespace' => 'Genuineq\JWTAuth\Http\Controllers',
        'middleware' => ['api'],
    ],
    function () {
        Route::post('register', 'RegisterController')->name('api.auth.register');

        Route::post('login', 'LoginController')->name('api.auth.login');

        Route::post('refresh', 'RefreshTokenController')->name('api.auth.refresh');

        Route::post('forgot-password', 'ForgotPasswordController')->name('api.auth.forgot-password');

        // Route::post('account-activation', 'ActivateController')->name('api.auth.account-activation');
        // Route::post('reset-password', 'ResetPasswordController')->name('api.auth.reset-password');

        Route::middleware(['jwt.auth'])->group(
            function () {
                Route::get('me', 'GetUserController')->name('api.auth.me');
            }
        );
    }
);
