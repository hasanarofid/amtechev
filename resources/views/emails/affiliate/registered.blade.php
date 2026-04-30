@component('mail::message')
# Welcome to the Team!

Hi {{ $affiliate->user->name }},

Congratulations! Your affiliate account has been successfully created. You can now start earning commissions by referring customers to Amtech EV Specialist.

**Your Referral Link:**
[{{ url('/ref/' . $affiliate->referral_code) }}]({{ url('/ref/' . $affiliate->referral_code) }})

**Quick Tips:**
- Share your link on social media and WhatsApp.
- Mention our 5% commission rate to potential partners.
- Track your earnings in real-time on your dashboard.

@component('mail::button', ['url' => route('affiliate.dashboard')])
Go to Dashboard
@endcomponent

Happy referring!

Regards,<br>
{{ config('app.name') }}
@endcomponent
