<?php

namespace Genuineq\JWTAuth\Classes;

use Genuineq\User\Classes\AuthManager as RainAuthManager;

/**
 * {@inheritDoc}
 */
class AuthManager extends RainAuthManager
{
    /**
     * {@inheritDoc}
     */
    protected $userModel = \Genuineq\JWTAuth\Models\User::class;
}
