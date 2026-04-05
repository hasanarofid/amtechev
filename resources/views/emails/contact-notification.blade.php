<x-mail::message>
# New Website Inquiry

You have received a new message from the AMTECH EV contact form.

<x-mail::panel>
**Inquiry Details:**

- **Name:** {{ $name }}
- **Email:** {{ $email }}
- **Phone:** {{ $phone ?? 'N/A' }}
</x-mail::panel>

**Message:**
{{ $comment }}

<x-mail::button :url="config('app.url') . '/admin/contact-inquiries'">
View in Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }} Team
</x-mail::message>
