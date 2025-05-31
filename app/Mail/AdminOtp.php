<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class AdminOtp extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * The OTP code.
     *
     * @var string
     */
    public $otpCode;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\User  $user
     * @param  string  $otpCode
     * @return void
     */
    public function __construct(User $user, $otpCode)
    {
        $this->user = $user;
        $this->otpCode = $otpCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Admin Login - OTP Verification Code')
                    ->markdown('emails.admin_otp')
                    ->with([
                        'name' => $this->user->username,
                        'otpCode' => $this->otpCode,
                        'expiresAt' => '10 minutes'
                    ]);
    }
}
