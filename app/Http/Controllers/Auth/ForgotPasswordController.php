<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    /**
     * Display the form to request a password reset.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Validate the email for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }

    /**
     * Send a reset code to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'We can\'t find a user with that email address.']);
        }

        // Generate a random 6-digit code
        $code = sprintf('%06d', mt_rand(100000, 999999));
        
        // Generate token for security
        $token = Str::random(60);

        // Store the token and code in the database
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'code' => $code,
                'created_at' => Carbon::now()
            ]
        );

        // For development/testing: Store the code in the session to display it
        // In production, you would use the email service instead
        session()->flash('reset_code', $code);
        session()->flash('reset_email', $user->email);

        // In a real production environment, uncomment this to send actual emails
        // $this->sendResetCodeEmail($user, $code, $token);

        return redirect()->route('password.reset', ['token' => $token])
            ->with('status', 'For testing purposes, your verification code is shown below.');
    }

    /**
     * Send the password reset code email.
     *
     * @param  \App\Models\User  $user
     * @param  string  $code
     * @param  string  $token
     * @return void
     */
    protected function sendResetCodeEmail($user, $code, $token)
    {
        $resetUrl = route('password.reset', ['token' => $token]);
        
        Mail::send('emails.password-reset', ['user' => $user, 'code' => $code, 'resetUrl' => $resetUrl], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Your Password Reset Code');
        });
    }
}