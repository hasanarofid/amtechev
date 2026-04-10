<x-mail::message>
# New Booking Request

Hello,

A new booking request has been received from the website. Below are the details:

<x-mail::panel>
**Customer Details**
- **Name:** {{ $booking->customer_name }}
- **Email:** {{ $booking->email ?? 'N/A' }}
- **Phone:** {{ $booking->phone_number }}
- **Preferred Date:** {{ \Carbon\Carbon::parse($booking->preferred_date)->format('d M Y') }}
- **Installation Address:** {{ $booking->address }}
</x-mail::panel>

## Selected Packages & Items

<x-mail::table>
| Item | Qty | Price | Total |
| :--- | :-- | :---- | :---- |
@foreach($items as $item)
| {{ $item->installationPackage->name }} | {{ $item->quantity }} | RM{{ number_format($item->price_at_booking, 2) }} | RM{{ number_format($item->price_at_booking * $item->quantity, 2) }} |
@endforeach
| **Total** | | | **RM{{ number_format($booking->total_price, 2) }}** |
</x-mail::table>

@if($booking->notes)
<x-mail::panel>
**Additional Notes:**
{{ $booking->notes }}
</x-mail::panel>
@endif

<x-mail::button :url="config('app.url') . '/admin/bookings/' . $booking->id">
View Booking in Admin Panel
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
