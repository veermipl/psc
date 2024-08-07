@component('mail::message')
# Congratulations, {{ $name }}!

We are pleased to inform you that your account has been approved. You can now access all the features available to our members.

## Your Details:
- **Name:** {{ $name }}
- **Email:** {{ $email }}
- **Phone Number:** {{ $contact ?? 'N/A' }}
- **Membership:** {{ $membership_type ?? 'N/A' }}
- **Registered At:** {{ $created_at->format('Y-m-d H:i:s') }}
- **Approved At:** {{ $approved_at->format('Y-m-d H:i:s') }}

@component('mail::button', ['url' => route('member.dashboard')])
    Access Your Account
@endcomponent

Thank you for being a part of our community!

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
