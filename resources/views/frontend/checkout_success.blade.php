<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Success – {{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/amtech-removebg.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl p-10 text-center">
        <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-10 h-10">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
            </svg>
        </div>
        
        <h1 class="text-3xl font-black mb-2">Thank You!</h1>
        <p class="text-gray-500 mb-8">Your order <span class="font-bold text-gray-900">#{{ $order->order_number }}</span> has been placed successfully.</p>
        
        <div class="bg-gray-50 rounded-2xl p-6 mb-8 text-left space-y-4">
            <div class="border-b border-gray-200 pb-3">
                <h3 class="text-xs font-black uppercase tracking-widest text-gray-400 mb-4">Summary</h3>
                <div class="space-y-3">
                    @foreach($order->items as $item)
                    <div class="flex justify-between items-start gap-2">
                        <div class="flex-1">
                            <p class="text-sm font-bold text-gray-900 leading-tight">{{ $item->product_name }}</p>
                            <p class="text-[10px] text-gray-400">Qty: {{ $item->quantity }}</p>
                        </div>
                        <span class="text-xs font-black whitespace-nowrap">RM{{ number_format($item->subtotal, 2) }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Status</span>
                    <span class="font-bold uppercase {{ $order->payment_status === 'paid' ? 'text-green-600' : 'text-orange-500' }}">
                        {{ $order->payment_status }}
                    </span>
                </div>
                <div class="flex justify-between text-base pt-2 border-t border-gray-100">
                    <span class="font-bold text-gray-900">Total Paid</span>
                    <span class="font-black text-ev-green">RM {{ number_format($order->total_price, 2) }}</span>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <a href="{{ route('home') }}" class="block w-full bg-[#1773B0] text-white font-bold py-4 rounded-xl transition-all hover:bg-[#156a9e] shadow-lg shadow-blue-900/10">
                Back to Home
            </a>
            @auth
            <a href="{{ route('user.orders') }}" class="block w-full bg-white text-gray-600 font-bold py-4 rounded-xl border border-gray-200 hover:bg-gray-50">
                View My Orders
            </a>
            @endauth
        </div>
    </div>
</body>
</html>
