<?php namespace Genuineq\Esense\Http\Controllers;

use Log;
use Lang;
use Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Genuineq\JWTAuth\Classes\JWTAuth;

class StudentsController extends Controller
{
    /**
     * Extracts all the students of the authenticated user
     *
     * @param JWTAuth $auth
     * @param Request $request
     *
     * @return Illuminate\Http\Response
     */
    public function __invoke(JWTAuth $auth, Request $request)
    {
        /** Prepare and send the response. */
        return response()->json($auth->user()->profile->students);
    }
}
