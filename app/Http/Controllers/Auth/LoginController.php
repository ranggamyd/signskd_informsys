<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request),
            3,
            1
        );
    }

    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        throw ValidationException::withMessages([
            'credentials' => [Lang::get('auth.throttle', ['seconds' => $seconds])],
        ])->status(429);
    }

    protected function clearLoginAttempts(Request $request)
    {
        $this->limiter()->clear($this->throttleKey($request));
    }

    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'credentials' => [trans('auth.failed')],
        ]);
    }
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        $login = request()->input('credentials');

        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$field => $login]);

        return $field;
    }
}
