@component('mail::message')
# New Member Registered

A new member has just registered on your platform.

**Member Details:**

- **Name:** {{ $name }}
- **Email:** {{ $email }}
- **Phone Number:** {{ $contact ?? 'N/A' }}
- **Membership:** {{ $membership_type ?? 'N/A' }}
- **Registered At:** {{ $created_at->format('Y-m-d H:i:s') }}

@component('mail::button', ['url' => route('admin.member.index')])
View Member
@endcomponent

Thank you for managing the platform!

Best Regards,<br>
{{ config('app.name') }}
@endcomponent
