<?php

namespace CodeFin\Http\Controllers\Api;

use CodeFin\Http\Controllers\Controller;
use CodeFin\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function accessToken(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->credentials($request);

        if ($token = \Auth::guard('api')->attempt($credentials)) {
            return $this->sendLoginResponse($request, $token);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        \Auth::guard('api')->logout();
        return response()->json([], 204);

    }

    public function refreshToken(Request $request)
    {
        $token = \Auth::guard('api')->refresh();
        return $this->sendLoginResponse($request, $token);
    }


    /**
     * @param Request $request
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(Request $request, $token)
    {
        return response()->json([
            'token' => $token
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        $message = Lang::get('auth.throttle', ['seconds' => $seconds]);

        return response()->json([
            'message' => $message
        ], 403);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json([
            'message'   => Lang::get('auth.failed')
        ], 400);
    }
}
