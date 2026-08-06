@extends('frontend.layouts.app')

@section('title', 'Booking Success – ' . config('app.name'))

@section('content')
    <div class="min-h-screen flex items-center justify-center p-6 pt-32 pb-24">
        <div class="max-w-md w-full bg-white dark:bg-[#0a0a0a] rounded-3xl shadow-xl p-10 text-center border border-gray-100 dark:border-white/5">
            <div class="w-20 h-20 bg-green-100 dark:bg-ev-green/20 text-green-600 dark:text-ev-green rounded-full flex items-center justify-center mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-10 h-10">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
            </div>
            
            <h1 class="text-3xl font-black mb-2 dark:text-white">Booking Received!</h1>
            <p class="text-gray-500 dark:text-gray-400 mb-8">Your booking <span class="font-bold text-gray-900 dark:text-white">#{{ $booking->order_number }}</span> has been submitted successfully.</p>
            
            <div class="bg-gray-50 dark:bg-white/5 rounded-2xl p-6 mb-8 text-left space-y-4">
                <div class="border-b border-gray-200 dark:border-white/10 pb-3">
                    <h3 class="text-xs font-black uppercase tracking-widest text-gray-400 mb-4">Summary</h3>
                    <div class="space-y-3">
                        @foreach($booking->items as $item)
                        <div class="flex justify-between items-start gap-2">
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-900 dark:text-white leading-tight">{{ $item->installationPackage->name ?? 'Package' }}</p>
                                <p class="text-[10px] text-gray-400">Qty: {{ $item->quantity }}</p>
                            </div>
                            <span class="text-xs font-black whitespace-nowrap dark:text-white">RM{{ number_format($item->price_at_booking * $item->quantity, 2) }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Date</span>
                        <span class="font-bold text-gray-900 dark:text-white">
                            {{ \Carbon\Carbon::parse($booking->preferred_date)->format('d M Y') }}
                        </span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Payment Status</span>
                        <span class="font-bold uppercase {{ $booking->payment_status === 'paid' ? 'text-green-600' : 'text-orange-500' }}">
                            {{ $booking->payment_status }}
                        </span>
                    </div>
                    <div class="flex justify-between text-base pt-2 border-t border-gray-100 dark:border-white/10">
                        <span class="font-bold text-gray-900 dark:text-white">Total</span>
                        <span class="font-black text-ev-green">RM {{ number_format($booking->total_price, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <a href="{{ route('home') }}" class="block w-full bg-[#1773B0] text-white font-bold py-4 rounded-xl transition-all hover:bg-[#156a9e] shadow-lg shadow-blue-900/10">
                    Back to Home
                </a>
                <p class="text-[10px] text-gray-400 px-4">
                    Our team will contact you via WhatsApp within 24 hours to confirm the installation details.
                </p>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('load', function() {
            window.dataLayer = window.dataLayer || [];
            
            // Clear the previous ecommerce object to prevent data pollution in GA4
            window.dataLayer.push({ ecommerce: null });
            
            // Push standard GA4 E-commerce Purchase event
            window.dataLayer.push({
                'event': 'purchase',
                'ecommerce': {
                    'transaction_id': '{{ $booking->order_number }}',
                    'value': {{ $booking->total_price }},
                    'currency': 'MYR',
                    'items': [
                        @foreach($booking->items as $item)
                        {
                            'item_id': '{{ $item->installation_package_id ?? "" }}',
                            'item_name': '{{ $item->installationPackage->name ?? "Package" }}',
                            'price': {{ $item->price_at_booking }},
                            'quantity': {{ $item->quantity }}
                        },
                        @endforeach
                    ]
                }
            });

            // TikTok Pixel Purchase tracking
            if (typeof ttq !== 'undefined') {
                ttq.track('CompletePayment', {
                    content_type: 'product',
                    content_id: '{{ $booking->order_number }}',
                    value: {{ (float) $booking->total_price }},
                    currency: 'MYR',
                    contents: [
                        @foreach($booking->items as $item)
                        {
                            content_id: '{{ $item->installation_package_id ?? $booking->order_number }}',
                            content_name: @json($item->installationPackage->name ?? "Package"),
                            quantity: {{ (int) $item->quantity }},
                            price: {{ (float) $item->price_at_booking }}
                        },
                        @endforeach
                    ]
                });
                ttq.track('Purchase', {
                    content_type: 'product',
                    content_id: '{{ $booking->order_number }}',
                    value: {{ (float) $booking->total_price }},
                    currency: 'MYR',
                    contents: [
                        @foreach($booking->items as $item)
                        {
                            content_id: '{{ $item->installation_package_id ?? $booking->order_number }}',
                            content_name: @json($item->installationPackage->name ?? "Package"),
                            quantity: {{ (int) $item->quantity }},
                            price: {{ (float) $item->price_at_booking }}
                        },
                        @endforeach
                    ]
                });
                ttq.track('PlaceAnOrder', {
                    content_type: 'product',
                    content_id: '{{ $booking->order_number }}',
                    value: {{ (float) $booking->total_price }},
                    currency: 'MYR',
                    contents: [
                        @foreach($booking->items as $item)
                        {
                            content_id: '{{ $item->installation_package_id ?? $booking->order_number }}',
                            content_name: @json($item->installationPackage->name ?? "Package"),
                            quantity: {{ (int) $item->quantity }},
                            price: {{ (float) $item->price_at_booking }}
                        },
                        @endforeach
                    ]
                });
            }

            // Legacy booking_complete event for existing GTM tags
            if (window.amtechTracking) {
                window.amtechTracking.pushEvent('booking_complete', {
                    'transaction_id': '{{ $booking->order_number }}',
                    'value': {{ $booking->total_price }},
                    'currency': 'MYR',
                    'items': [
                        @foreach($booking->items as $item)
                        {
                            'item_name': '{{ $item->installationPackage->name ?? "Package" }}',
                            'price': {{ $item->price_at_booking }},
                            'quantity': {{ $item->quantity }}
                        },
                        @endforeach
                    ]
                });
            }
        });
    </script>
@endsection
