@component('mail::message')
# Dear {{ $name }},

Welcome to {{ $app_name }}! We’re excited to have you on board.

Your account has been successfully created. Here are your login details:

- **Email:** {{ $email }}
- **Password:** {{ $password }}

@component('mail::button', ['url' => route('login')])
    Login To Your Account
@endcomponent

Please log in to your account using the credentials above. For security reasons, we recommend that you change your password after logging in for the first time.

If you have any questions or need assistance, feel free to contact our support team at {{ $support_mail }}.

Thank you for joining us!

Best Regards,<br>
{{ config('app.name') }}

@endcomponent
