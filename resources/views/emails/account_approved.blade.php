@component('mail::message')
# Account Approved

Dear {{ $user->username }},

Congratulations! Your account registration has been approved by an administrator. You can now log in to the system using your username and password.

## Account Details

- **Username:** {{ $user->username }}
- **Region:** {{ $user->region->name }}
- **Station:** {{ $user->station->name }}
- **Designation:** {{ $user->designation }}

@component('mail::button', ['url' => route('login')])
Login Now
@endcomponent

After logging in, you can complete your profile by adding:
- Your date of birth
- A profile image
- A short bio/description

Thank you for your patience during the approval process. We're excited to have you on board!

If you have any questions or need assistance, please don't hesitate to contact our support team.

Regards,<br>
{{ config('app.name') }}

@component('mail::subcopy')
If you're having trouble clicking the "Login Now" button, copy and paste the URL below into your web browser: {{ route('login') }}
@endcomponent
@endcomponent