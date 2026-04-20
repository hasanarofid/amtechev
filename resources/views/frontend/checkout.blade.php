<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout – {{ $settings['site_title'] ?? 'Amtech EV Specialist' }}</title>
    
    <link rel="icon" type="image/png" href="{{ asset('logo/amtech-removebg.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #ffffff; color: #1a1a1a; }
        .checkout-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            transition: all 0.2s;
        }
        .checkout-input:focus {
            outline: none;
            border-color: #3BB77E;
            box-shadow: 0 0 0 1px #3BB77E;
        }
        .checkout-label {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.75rem;
            color: #6b7280;
            pointer-events: none;
            transition: all 0.2s;
        }
        .checkout-input:not(:placeholder-shown) + .checkout-label,
        .checkout-input:focus + .checkout-label {
            top: 0.5rem;
            font-size: 0.65rem;
            color: #3BB77E;
        }
        .checkout-input::placeholder {
            color: transparent;
        }
    </style>
</head>
<body class="antialiased">

    <!-- Simple Checkout Header -->
    <header class="py-6 px-4 md:px-14 border-b border-gray-100 bg-white sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-black italic tracking-tighter">
                Amtech <span class="text-ev-green">EV</span>
            </a>
            <a href="{{ route('catalog') }}" class="text-gray-400 hover:text-gray-900 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.112 16.856a.45.45 0 0 1-.448.48H4.5a.45.45 0 0 1-.448-.48L5.164 8.507a.45.45 0 0 1 .448-.48h13.256a.45.45 0 0 1 .448.48Zm-12.723.411 1.077 15.394a.45.45 0 0 0 .448.419H17.58a.45.45 0 0 0 .448-.419l1.077-15.394H6.233Z" />
                </svg>
            </a>
        </div>
    </header>

    <main class="max-w-7xl mx-auto min-h-screen flex flex-col md:flex-row">
        <!-- Left Column: Checkout Form -->
        <div class="flex-1 p-4 md:p-14 md:border-r border-gray-100">
            <nav class="text-xs text-gray-500 mb-8 flex gap-2">
                <a href="#" class="text-[#3BB77E]">Cart</a>
                <span>></span>
                <span class="text-gray-900 font-bold">Information</span>
                <span>></span>
                <span>Shipping</span>
                <span>></span>
                <span>Payment</span>
            </nav>

            <div class="space-y-10">
                <!-- Express Checkout -->
                <div class="border border-gray-100 rounded-xl p-6 text-center">
                    <p class="text-[10px] text-gray-400 uppercase tracking-widest font-black mb-4">Express checkout</p>
                    <div class="flex flex-col md:flex-row gap-3">
                        <button class="flex-1 bg-[#ffc439] hover:bg-[#f2ba32] py-3 rounded-lg flex items-center justify-center transition-all">
                            <img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-medium.png" alt="PayPal" class="h-6">
                        </button>
                    </div>
                </div>

                <div class="relative py-4 flex items-center">
                    <div class="flex-grow border-t border-gray-100"></div>
                    <span class="flex-shrink mx-4 text-xs text-gray-400 font-black uppercase tracking-widest">or</span>
                    <div class="flex-grow border-t border-gray-100"></div>
                </div>

                <!-- Contact Section -->
                <section>
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">Contact</h2>
                        <a href="{{ route('login') }}" class="text-[10px] text-[#3BB77E] underline uppercase font-black">Log in</a>
                    </div>
                    <div class="relative">
                        <input type="text" placeholder="Email or mobile phone number" class="checkout-input" id="contact">
                        <label for="contact" class="checkout-label">Email or mobile phone number</label>
                    </div>
                    <div class="mt-4 flex items-center gap-3">
                        <input type="checkbox" id="news" class="w-4 h-4 accent-[#3BB77E] rounded">
                        <label for="news" class="text-xs text-gray-600">Email me with news and offers</label>
                    </div>
                </section>

                <!-- Delivery Section -->
                <section>
                    <h2 class="text-xl font-bold mb-4">Delivery</h2>
                    <div class="space-y-3">
                        <div class="relative">
                            <select class="checkout-input appearance-none bg-no-repeat bg-[right_1rem_center]" style="background-image: url('data:image/svg+xml;charset=utf-8,<svg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' viewBox=\'0 0 20 20\'><path stroke=\'%236b7280\' stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'1.5\' d=\'m6 8 4 4 4-4\'/></svg>');">
                                <option value="MY">Malaysia</option>
                            </select>
                            <span class="checkout-label">Country/Region</span>
                        </div>
                        <div class="flex gap-3">
                            <div class="relative flex-1">
                                <input type="text" placeholder="First name (optional)" class="checkout-input" id="fname">
                                <label for="fname" class="checkout-label">First name (optional)</label>
                            </div>
                            <div class="relative flex-1">
                                <input type="text" placeholder="Last name" class="checkout-input" id="lname">
                                <label for="lname" class="checkout-label">Last name</label>
                            </div>
                        </div>
                        <div class="relative">
                            <input type="text" placeholder="Address" class="checkout-input" id="address">
                            <label for="address" class="checkout-label">Address</label>
                        </div>
                        <div class="relative">
                            <input type="text" placeholder="Apartment, suite, etc. (optional)" class="checkout-input" id="apt">
                            <label for="apt" class="checkout-label">Apartment, suite, etc. (optional)</label>
                        </div>
                        <div class="flex gap-3">
                            <div class="relative flex-1">
                                <input type="text" placeholder="Postcode" class="checkout-input" id="postcode">
                                <label for="postcode" class="checkout-label">Postcode</label>
                            </div>
                            <div class="relative flex-1">
                                <input type="text" placeholder="City" class="checkout-input" id="city">
                                <label for="city" class="checkout-label">City</label>
                            </div>
                            <div class="relative flex-1">
                                <select class="checkout-input appearance-none">
                                    <option value="">State/territory</option>
                                    <option value="KL">Kuala Lumpur</option>
                                    <option value="SEL">Selangor</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center gap-3">
                            <input type="checkbox" id="save" class="w-4 h-4 accent-[#3BB77E] rounded">
                            <label for="save" class="text-xs text-gray-600">Save this information for next time</label>
                        </div>
                    </div>
                </section>

                <!-- Shipping Method -->
                <section>
                    <h2 class="text-xl font-bold mb-4">Shipping method</h2>
                    <div class="bg-gray-50 border border-gray-100 rounded-lg p-6 text-center">
                        <p class="text-xs text-gray-400">Enter your shipping address to view available shipping methods.</p>
                    </div>
                </section>

                <!-- Payment Section -->
                <section>
                    <h2 class="text-xl font-bold mb-1">Payment</h2>
                    <p class="text-xs text-gray-500 mb-4">All transactions are secure and encrypted.</p>
                    
                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <div class="p-4 flex justify-between items-center bg-[#f0f5ff] border-b border-gray-200">
                            <div class="flex items-center gap-3">
                                <input type="radio" checked name="payment" class="w-4 h-4 accent-[#3BB77E]">
                                <span class="text-sm font-bold">PayPal</span>
                            </div>
                            <img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-medium.png" alt="PayPal" class="h-4">
                        </div>
                        <div class="p-10 text-center bg-gray-50">
                            <div class="flex justify-center mb-4">
                                <svg class="w-16 h-16 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <p class="text-sm text-gray-500">You'll be redirected to PayPal to complete your purchase</p>
                        </div>
                    </div>
                </section>

                <!-- Billing Address -->
                <section>
                    <h2 class="text-xl font-bold mb-4">Billing address</h2>
                    <div class="border border-gray-200 rounded-xl divide-y divide-gray-200 overflow-hidden">
                        <label class="p-4 flex items-center gap-3 cursor-pointer hover:bg-gray-50">
                            <input type="radio" checked name="billing" class="w-4 h-4 accent-[#3BB77E]">
                            <span class="text-xs font-bold text-gray-700">Same as shipping address</span>
                        </label>
                        <label class="p-4 flex items-center gap-3 cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="billing" class="w-4 h-4 accent-[#3BB77E]">
                            <span class="text-xs font-bold text-gray-700">Use a different billing address</span>
                        </label>
                    </div>
                </section>

                <button class="w-full bg-[#1773B0] hover:bg-[#156a9e] text-white font-bold py-4 rounded-xl transition-all text-sm tracking-widest uppercase text-center shadow-lg shadow-blue-900/10">
                    Pay with PayPal
                </button>

                <footer class="pt-10 border-t border-gray-100 flex gap-4 text-[10px] text-[#3BB77E] uppercase font-black underline">
                    <a href="#">Refund policy</a>
                    <a href="#">Privacy policy</a>
                    <a href="#">Terms of service</a>
                    <a href="#">Contact</a>
                </footer>
            </div>
        </div>

        <!-- Right Column: Order Summary -->
        <div class="w-full md:w-[450px] bg-gray-50 p-4 md:p-14 md:sticky md:top-0 md:h-screen overflow-y-auto">
            <div class="space-y-6">
                @php
                    $total = 0;
                @endphp
                @foreach($cart as $id => $item)
                    @php
                        $price = (float)str_replace(['RM', ',', ' '], '', $item['price'] ?? 0);
                        $itemTotal = $price * (int)($item['quantity'] ?? 1);
                        $total += $itemTotal;
                    @endphp
                    <div class="flex items-center gap-4">
                        <div class="relative w-16 h-16 bg-white border border-gray-200 rounded-lg p-1">
                            <img src="{{ (str_starts_with($item['image'], 'http') || str_starts_with($item['image'], 'data:') || str_starts_with($item['image'], '/')) ? $item['image'] : asset('storage/' . $item['image']) }}" class="w-full h-full object-contain">
                            <span class="absolute -top-2 -right-2 bg-gray-500 text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center">
                                {{ $item['quantity'] }}
                            </span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-xs font-bold text-gray-900 leading-snug truncate">{{ $item['name'] }}</h3>
                            <p class="text-[10px] text-gray-400">Black / 5m / No Installation</p>
                        </div>
                        <p class="text-xs font-bold">RM{{ number_format($itemTotal, 2) }}</p>
                    </div>
                @endforeach

                <div class="flex gap-3 py-6">
                    <input type="text" placeholder="Discount code" class="checkout-input flex-1">
                    <button class="bg-[#e5e7eb] hover:bg-[#d1d5db] px-5 py-3 rounded-lg text-xs font-bold text-gray-600 transition-all">Apply</button>
                </div>

                <div class="space-y-2 text-xs">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">Subtotal</span>
                        <span class="font-bold uppercase">RM {{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">Shipping</span>
                        <span class="text-[10px] text-gray-400">Enter shipping address</span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                        <span class="text-lg font-bold">Total</span>
                        <div class="text-right">
                            <span class="text-[10px] text-gray-400">MYR</span>
                            <span class="text-2xl font-black italic ml-2">RM {{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
