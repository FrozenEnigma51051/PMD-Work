<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username'; // Assuming you're using 'username' as the login identifier
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // Regenerate session to prevent session fixation attacks
        $request->session()->regenerate();
        
        // If the user is not active, log them out and show a validation error
        if ($user->status !== 'active') {
            auth()->logout();

            throw ValidationException::withMessages([
                $this->username() => ['Your account is pending admin approval.'],
            ]);
        }

        // Redirect based on the user's role
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }

    /**
     * Determine the redirect path after login (redundant if 'authenticated' method is used)
     *
     * @return string
     */
    protected function redirectTo()
    {
        // This is technically redundant if `authenticated()` handles redirects
        if (auth()->user()->isAdmin()) {
            return route('admin.dashboard');
        } else {
            return route('user.dashboard');
        }
    }
}
