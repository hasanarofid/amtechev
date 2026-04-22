@component('mail::message')
# Invoice #{{ $order->order_number }}

Hello {{ $order->customer_first_name }},

Thank you for your purchase with **Amtech EV**. Your payment has been successfully processed, and we are now preparing your order.

### Order Summary
**Order Number:** {{ $order->order_number }}
**Date:** {{ $order->created_at->format('d M Y, H:i') }}
**Status:** {{ strtoupper($order->payment_status) }}

---

### Billing Details
**Name:** {{ $order->customer_first_name }} {{ $order->customer_last_name }}
**Phone:** {{ $order->customer_phone }}
**Address:**
{{ $order->customer_address }},
{{ $order->customer_postcode }} {{ $order->customer_city }},
{{ $order->customer_state }}, {{ $order->customer_country }}

---

### Items Purchased
@component('mail::table')
| Item | Qty | Price | Total |
| :--- | :---: | :---: | :--- |
@foreach($order->items as $item)
| **{{ $item->product_name }}**<br><small>@if(isset($item->attributes['color'])) Color: {{ $item->attributes['color'] }} @endif @if(isset($item->attributes['cable_length'])) | Cable: {{ $item->attributes['cable_length'] }} @endif</small> | {{ $item->quantity }} | RM{{ number_format($item->price, 2) }} | RM{{ number_format($item->subtotal, 2) }} |
@endforeach
| | | **Subtotal** | RM{{ number_format($order->total_price, 2) }} |
| | | **Total (MYR)** | **RM{{ number_format($order->total_price, 2) }}** |
@endcomponent

@component('mail::button', ['url' => route('user.dashboard')])
View My Orders
@endcomponent

If you have any questions regarding this invoice, please contact our support team at info@amtechev.com or reply to this email.

Thanks,<br>
**{{ config('app.name') }} Team**
@endcomponent
