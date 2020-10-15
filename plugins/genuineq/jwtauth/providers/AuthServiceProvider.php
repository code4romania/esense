<?php

namespace Genuineq\JWTAuth\Providers;

use Config;
use Illuminate\Http\Response;
use Genuineq\User\Models\User;
use Tymon\JWTAuth\Providers\AbstractServiceProvider;
use Genuineq\JWTAuth\Models\Settings as PluginSettings;
use Genuineq\JWTAuth\Exceptions\JsonValidationException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthServiceProvider extends AbstractServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        /** Register the error handler to the validation exception. */
        $this->app->error(
            function (JsonValidationException $exception) {
                return $exception->toArray();
            }
        );

        /** Register the error handler to the unauthorized HTTP exception. */
        $this->app->error(
            function (UnauthorizedHttpException $exception) {
                return response()->json(
                    ['error' => $exception->getMessage(),],
                    Response::HTTP_UNAUTHORIZED
                );
            }
        );

        $this->bindRequests();
        $this->loadConfiguration();
        $this->aliasMiddleware();
    }

    /**
     * Binding the requests that works almost like the Laravel FormRequests
     *
     * @return void
     */
    protected function bindRequests()
    {
        $this->app->bind(
            \Genuineq\JWTAuth\Http\Requests\TokenRequest::class,
            function ($app) {
                return new \Genuineq\JWTAuth\Http\Requests\TokenRequest(input());
            }
        );

        $this->app->bind(
            \Genuineq\JWTAuth\Http\Requests\LoginRequest::class,
            function ($app) {
                return new \Genuineq\JWTAuth\Http\Requests\LoginRequest(input());
            }
        );

        $this->app->bind(
            \Genuineq\JWTAuth\Http\Requests\ActivationRequest::class,
            function ($app) {
                return new \Genuineq\JWTAuth\Http\Requests\ActivationRequest(input());
            }
        );

        $this->app->bind(
            \Genuineq\JWTAuth\Http\Requests\ForgotPasswordRequest::class,
            function ($app) {
                return new \Genuineq\JWTAuth\Http\Requests\ForgotPasswordRequest(input());
            }
        );

        $this->app->bind(
            \Genuineq\JWTAuth\Http\Requests\RegisterRequest::class,
            function ($app) {
                return new \Genuineq\JWTAuth\Http\Requests\RegisterRequest(input());
            }
        );

        $this->app->bind(
            \Genuineq\JWTAuth\Http\Requests\ResetPasswordRequest::class,
            function ($app) {
                return new \Genuineq\JWTAuth\Http\Requests\ResetPasswordRequest(input());
            }
        );

        /** Resolving the bindings above and validating it. */
        $this->app->resolving(
            \Genuineq\JWTAuth\Http\Requests\Request::class,
            function ($request, $app) {
                $request->validate();
            }
        );
    }

    /**
     * Load JWT Configuration
     *
     * @return void
     */
    protected function loadConfiguration()
    {
        /**
         * Some of default values that doesn't need to be configured by
         *  the user are included on this file.
         */
        Config::set('jwt', include realpath(__DIR__ . '/../config/jwt.php'));

        $attributes = PluginSettings::instance()->attributes;
        foreach ($attributes as $attr => $value) {
            $config = 'jwt.' . str_replace('keys_', 'keys.', $attr);

            if ($config == 'jwt.required_claims'
                || $config == 'jwt.persistent_claims'
            ) {
                $value = explode(' ', $value);
            }

            if ($config == 'jwt.decrypt_cookies') {
                /** This is confusing. 'Cause it should be an inverse logic. */
                $value = !$value;
            }

            $isInteger = in_array(
                $config,
                [
                    'jwt.ttl',
                    'jwt.refresh_ttl',
                    'jwt.leeway',
                    'jwt.blacklist_grace_period'
                ]
            );

            if ($isInteger) {
                $value = (int)$value;
            }

            Config::set($config, $value);
        }
    }

    /**
     * Alias the middleware.
     *
     * @return void
     */
    protected function aliasMiddleware()
    {
        $router = $this->app['router'];
        $method = (method_exists($router, 'aliasMiddleware')) ? ('aliasMiddleware') : ('middleware');

        foreach ($this->middlewareAliases as $alias => $middleware) {
            $router->$method($alias, $middleware);
        }
    }
}
