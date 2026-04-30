@component('mail::message')
# Great News!

You have just earned a new commission from a successful referral.

**Details:**
- **Amount:** RM {{ number_format($commission->amount, 2) }}
- **Source:** {{ $commission->order_id ? 'Order #' . $commission->order->order_number : 'Booking #' . $commission->booking_id }}
- **Date:** {{ $commission->created_at->format('d M Y H:i') }}

Your earnings have been added to your pending balance. Once the transaction is fully verified, it will be added to your available balance for withdrawal.

@component('mail::button', ['url' => route('affiliate.dashboard')])
View Dashboard
@endcomponent

Thank you for being a valued Amtech Partner!

Regards,<br>
{{ config('app.name') }}
@endcomponent
