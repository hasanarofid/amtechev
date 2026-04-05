<x-mail::message>
# Hello, {{ $name }}

Thank you for reaching out to EVSify. Regarding your inquiry:

<x-mail::panel>
**Your Message:**
{{ $originalMessage }}
</x-mail::panel>

**Our Response:**

{{ $replyMessage }}

If you have any further questions, feel free to reply to this email or visit our website.

Thanks,<br>
{{ config('app.name') }} Team
</x-mail::message>
