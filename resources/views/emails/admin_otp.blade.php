@component('mail::message')
# Admin Login - OTP Verification

Hello **{{ $name }}**,

You are attempting to log in to the admin panel. For security purposes, please use the following One-Time Password (OTP) to complete your login:

@component('mail::panel')
## Your OTP Code: **{{ $otpCode }}**
@endcomponent

**Important Information:**
- This OTP will expire in **{{ $expiresAt }}**
- Do not share this code with anyone
- If you did not attempt to log in, please ignore this email

Please enter this code on the verification page to complete your login.

@component('mail::button', ['url' => config('app.url')])
Go to Login Page
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team

---
*This is an automated email. Please do not reply to this message.*
@endcomponent 