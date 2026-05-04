@extends('frontend.layouts.app')

@section('title', 'Checkout – ' . ($settings['site_title'] ?? 'Amtech EV Specialist'))

@push('styles')
<style>
    .checkout-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        transition: all 0.2s;
        background-color: transparent;
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
    .dark .checkout-input {
        border-color: rgba(255, 255, 255, 0.1);
        color: white;
    }
</style>
@endpush

@section('content')
    <main class="max-w-7xl mx-auto min-h-screen flex flex-col md:flex-row pt-24">
        <!-- Left Column: Checkout Form -->
        <div class="flex-1 p-4 md:p-14 md:border-r border-gray-100 dark:border-white/5">
            <nav class="text-xs text-gray-500 mb-8 flex gap-2">
                <a href="#" class="text-[#3BB77E]">Cart</a>
                <span>></span>
                <span class="text-gray-900 dark:text-white font-bold">Information</span>
                <span>></span>
                <span>Shipping</span>
                <span>></span>
                <span>Payment</span>
            </nav>

            <div class="space-y-10">
                <!-- Contact Section -->
                <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                    @csrf
                    
                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <section>
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Contact</h2>
                            @guest
                            <a href="{{ route('user.login') }}" class="text-[10px] text-[#3BB77E] underline uppercase font-black">Log in</a>
                            @endguest
                        </div>
                        <div class="relative">
                            <input type="email" name="email" placeholder="Email" class="checkout-input" id="contact" required value="{{ old('email', auth()->user()->email ?? '') }}">
                            <label for="contact" class="checkout-label">Email</label>
                        </div>
                        <div class="mt-4 flex items-center gap-3">
                            <input type="checkbox" id="news" class="w-4 h-4 accent-[#3BB77E] rounded">
                            <label for="news" class="text-xs text-gray-600 dark:text-gray-400">Email me with news and offers</label>
                        </div>
                    </section>

                <!-- Delivery Section -->
                <section class="mt-10">
                    <h2 class="text-xl font-bold mb-4">Delivery</h2>
                    <div class="space-y-3">
                        <div class="relative">
                            <select name="country" class="checkout-input appearance-none bg-no-repeat bg-[right_1rem_center] dark:bg-[#0a0a0a]" style="background-image: url('data:image/svg+xml;charset=utf-8,<svg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' viewBox=\'0 0 20 20\'><path stroke=\'%236b7280\' stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'1.5\' d=\'m6 8 4 4 4-4\'/></svg>');">
                                <option value="MY">Malaysia</option>
                            </select>
                            <span class="checkout-label">Country/Region</span>
                        </div>
                        <div class="flex gap-3">
                            <div class="relative flex-1">
                                <input type="text" name="first_name" placeholder="First name (optional)" class="checkout-input" id="fname" value="{{ old('first_name', auth()->user()->first_name ?? '') }}">
                                <label for="fname" class="checkout-label">First name (optional)</label>
                            </div>
                            <div class="relative flex-1">
                                <input type="text" name="last_name" placeholder="Last name" class="checkout-input" id="lname" required value="{{ old('last_name', auth()->user()->last_name ?? '') }}">
                                <label for="lname" class="checkout-label">Last name</label>
                            </div>
                        </div>
                        <div class="relative">
                            <input type="text" name="address" placeholder="Address" class="checkout-input" id="address" required value="{{ old('address', auth()->user()->address ?? '') }}">
                            <label for="address" class="checkout-label">Address</label>
                        </div>
                        <div class="relative">
                            <input type="text" name="apt" placeholder="Apartment, suite, etc. (optional)" class="checkout-input" id="apt">
                            <label for="apt" class="checkout-label">Apartment, suite, etc. (optional)</label>
                        </div>
                        <div class="flex gap-3">
                            <div class="relative flex-1">
                                <input type="text" name="postcode" placeholder="Postcode" class="checkout-input" id="postcode" required value="{{ old('postcode', auth()->user()->postcode ?? '') }}">
                                <label for="postcode" class="checkout-label">Postcode</label>
                            </div>
                            <div class="relative flex-1">
                                <input type="text" name="city" placeholder="City" class="checkout-input" id="city" required value="{{ old('city', auth()->user()->city ?? '') }}">
                                <label for="city" class="checkout-label">City</label>
                            </div>
                            <div class="relative flex-1">
                                <select name="state" class="checkout-input appearance-none dark:bg-[#0a0a0a]" required>
                                    <option value="">State/territory</option>
                                    @php
                                        $userState = old('state', auth()->user()->state ?? '');
                                    @endphp
                                    <option value="KL" {{ $userState === 'KL' ? 'selected' : '' }}>Kuala Lumpur</option>
                                    <option value="SEL" {{ $userState === 'SEL' ? 'selected' : '' }}>Selangor</option>
                                    <option value="JHR" {{ $userState === 'JHR' ? 'selected' : '' }}>Johor</option>
                                    <option value="PEN" {{ $userState === 'PEN' ? 'selected' : '' }}>Penang</option>
                                </select>
                            </div>
                        </div>
                        <div class="relative mt-3">
                            <input type="text" name="phone" placeholder="Phone" class="checkout-input" id="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}">
                            <label for="phone" class="checkout-label">Phone</label>
                        </div>
                    </div>
                </section>

                <!-- Shipping Method -->
                <section class="mt-10">
                    <h2 class="text-xl font-bold mb-4">Shipping method</h2>
                    <div class="bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/5 rounded-lg p-6 text-center">
                        <p class="text-xs text-gray-400">Enter your shipping address to view available shipping methods.</p>
                    </div>
                </section>

                <!-- Payment Section -->
                <section class="mt-10">
                    <h2 class="text-xl font-bold mb-1">Payment</h2>
                    <p class="text-xs text-gray-500 mb-4">All transactions are secure and encrypted.</p>
                    
                    <div class="border border-gray-200 dark:border-white/10 rounded-xl overflow-hidden">
                        <div class="p-4 flex justify-between items-center bg-[#f0f5ff] dark:bg-ev-green/10 border-b border-gray-200 dark:border-white/10">
                            <div class="flex items-center gap-3">
                                <input type="radio" checked name="payment_method" value="bayarcash" class="w-4 h-4 accent-[#3BB77E]">
                                <span class="text-sm font-bold">Bayar Cash</span>
                            </div>
                            <div class="flex gap-2">
                                <img src="https://plugin.bayarcash.com/assets/images/fpx.png" alt="FPX" class="h-4">
                                <img src="https://plugin.bayarcash.com/assets/images/duitnow.png" alt="DuitNow" class="h-4">
                            </div>
                        </div>
                        <div class="p-10 text-center bg-gray-50 dark:bg-white/5">
                            <div class="flex justify-center mb-4">
                                <svg class="w-16 h-16 text-gray-200 dark:text-white/10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <p class="text-sm text-gray-500">You'll be redirected to Bayar Cash to complete your purchase</p>
                        </div>
                    </div>
                </section>

                <!-- Billing Address -->
                <section class="mt-10">
                    <h2 class="text-xl font-bold mb-4">Billing address</h2>
                    <div class="border border-gray-200 dark:border-white/10 rounded-xl divide-y divide-gray-200 dark:divide-white/10 overflow-hidden">
                        <label class="p-4 flex items-center gap-3 cursor-pointer hover:bg-gray-50 dark:hover:bg-white/5">
                            <input type="radio" checked name="billing" class="w-4 h-4 accent-[#3BB77E]">
                            <span class="text-xs font-bold text-gray-700 dark:text-gray-300">Same as shipping address</span>
                        </label>
                        <label class="p-4 flex items-center gap-3 cursor-pointer hover:bg-gray-50 dark:hover:bg-white/5">
                            <input type="radio" name="billing" class="w-4 h-4 accent-[#3BB77E]">
                            <span class="text-xs font-bold text-gray-700 dark:text-gray-300">Use a different billing address</span>
                        </label>
                    </div>
                </section>

                <button type="submit" id="pay-now-button" class="w-full bg-[#3BB77E] hover:bg-[#32a36d] text-white font-bold py-4 rounded-xl transition-all text-sm tracking-widest uppercase text-center shadow-lg shadow-green-900/10">
                    Pay Now
                </button>
                </form>

                <footer class="pt-10 border-t border-gray-100 dark:border-white/5 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex gap-4 text-[10px] text-[#3BB77E] uppercase font-black underline">
                        <a href="#">Refund policy</a>
                        <a href="#">Privacy policy</a>
                        <a href="#">Terms of service</a>
                        <a href="#">Contact</a>
                    </div>
                    <p class="text-[10px] text-gray-400 uppercase font-black">developer by <a href="https://hasanarofid.site" class="text-ev-green hover:underline">hasanarofid.site</a></p>
                </footer>
            </div>
        </div>

        <!-- Right Column: Order Summary -->
        <div class="w-full md:w-[450px] bg-gray-50 dark:bg-white/5 p-4 md:p-14 md:sticky md:top-0 md:h-screen overflow-y-auto">
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
                        <div class="relative w-16 h-16 bg-white dark:bg-[#0a0a0a] border border-gray-200 dark:border-white/10 rounded-lg p-1">
                            <img src="{{ (str_starts_with($item['image'], 'http') || str_starts_with($item['image'], 'data:') || str_starts_with($item['image'], '/')) ? $item['image'] : asset('storage/' . $item['image']) }}" class="w-full h-full object-contain">
                            <span class="absolute -top-2 -right-2 bg-gray-500 text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center">
                                {{ $item['quantity'] }}
                            </span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-xs font-bold text-gray-900 dark:text-white leading-snug truncate">{{ $item['name'] }}</h3>
                            <p class="text-[10px] text-gray-400">Black / 5m / No Installation</p>
                        </div>
                        <p class="text-xs font-bold dark:text-white">RM{{ number_format($itemTotal, 2) }}</p>
                    </div>
                @endforeach

                <div class="flex gap-3 py-6">
                    <input type="text" placeholder="Discount code" class="checkout-input flex-1">
                    <button class="bg-[#e5e7eb] dark:bg-white/10 hover:bg-[#d1d5db] px-5 py-3 rounded-lg text-xs font-bold text-gray-600 dark:text-gray-400 transition-all">Apply</button>
                </div>

                <div class="space-y-2 text-xs">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">Subtotal</span>
                        <span class="font-bold uppercase dark:text-white">RM {{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">Shipping</span>
                        <span class="text-[10px] text-gray-400">Enter shipping address</span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-white/10">
                        <span class="text-lg font-bold dark:text-white">Total</span>
                        <div class="text-right">
                            <span class="text-[10px] text-gray-400">MYR</span>
                            <span class="text-2xl font-black italic ml-2 dark:text-white">RM {{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('checkout-form');
        const payButton = document.getElementById('pay-now-button');
        
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Show loading state on button
            const originalText = payButton.innerHTML;
            payButton.disabled = true;
            payButton.innerHTML = `<span class="flex items-center justify-center gap-2"><svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> REDIRECTING...</span>`;

            try {
                const formData = new FormData(form);
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Redirect directly to the payment URL
                    window.location.href = data.url;
                } else {
                    alert(data.message || 'An error occurred. Please try again.');
                    payButton.disabled = false;
                    payButton.innerHTML = originalText;
                }
            } catch (error) {
                console.error('Checkout Error:', error);
                alert('Failed to process checkout. Please check your connection.');
                payButton.disabled = false;
                payButton.innerHTML = originalText;
            }
        });
    });
</script>
@endpush
