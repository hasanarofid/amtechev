@extends('frontend.layouts.app')

@section('title', 'Complete Your Booking – AMTECH EV Specialist')
@section('meta_description', 'Enter your details and complete your EV charger installation booking with AMTECH EV.')

@push('styles')
<style>
    .pay-page {
        padding-top: 7rem;
        padding-bottom: 5rem;
        min-height: 100vh;
        background: var(--bg-color);
    }
    .pay-card {
        background: var(--bg-card);
        border: 1px solid var(--glass-border);
        border-radius: 1.5rem;
        padding: 1.75rem;
    }
    .pay-input {
        width: 100%;
        background: var(--glass);
        border: 1px solid var(--glass-border);
        border-radius: 0.75rem;
        color: var(--text-main);
        padding: 0.875rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.25s ease;
        outline: none;
    }
    .pay-input:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(0,166,81,0.15);
    }
    .pay-input::placeholder { color: var(--text-muted); opacity: 0.65; }

    /* Payment Method Cards */
    .pay-method {
        border: 2px solid var(--glass-border);
        border-radius: 1rem;
        padding: 1rem 1.25rem;
        cursor: pointer;
        transition: all 0.2s ease;
        background: var(--bg-card);
        display: flex;
        align-items: center;
        gap: 0.875rem;
    }
    .pay-method:hover { border-color: rgba(0,166,81,0.4); }
    .pay-method--selected {
        border-color: var(--accent) !important;
        background: rgba(0,166,81,0.05) !important;
    }
    .pay-radio {
        width: 1.1rem;
        height: 1.1rem;
        border-radius: 50%;
        border: 2px solid var(--glass-border);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.2s ease;
    }
    .pay-radio--selected {
        border-color: var(--accent);
        background: var(--accent);
    }
    .pay-radio--selected::after {
        content: '';
        width: 0.35rem;
        height: 0.35rem;
        border-radius: 50%;
        background: #000;
    }

    /* Submit button */
    .submit-btn {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 1rem;
        background: var(--accent);
        color: #000;
        font-weight: 900;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        border-radius: 999px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(0,166,81,0.3);
    }
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(0,166,81,0.42);
        filter: brightness(1.08);
    }
    .submit-btn:disabled {
        opacity: 0.45;
        cursor: not-allowed;
        box-shadow: none;
        transform: none;
    }

    /* Back link */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--text-muted);
        text-decoration: none;
        transition: color 0.2s ease;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }
    .back-link:hover { color: var(--accent); }

    /* Order item row */
    .order-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 0.5rem;
        font-size: 0.8rem;
        padding: 0.5rem 0;
        border-bottom: 1px solid var(--glass-border);
    }
    .order-row:last-child { border-bottom: none; }

    /* Step breadcrumb */
    .step-bar {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 2rem;
    }
    .step-dot {
        width: 1.75rem;
        height: 1.75rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        font-weight: 900;
        flex-shrink: 0;
    }
    .step-line {
        flex: 1;
        height: 2px;
        border-radius: 99px;
    }

    @media (max-width: 640px) {
        .pay-page { padding-top: 6rem; }
        .pay-card { padding: 1.25rem; }
    }
</style>
@endpush

@section('content')
@php
    $items        = $draft['items'];
    $totalPrice   = $draft['total_price'];
    $prefDate     = $draft['preferred_date'];
    $formattedDate = \Carbon\Carbon::parse($prefDate)->format('l, d F Y');
@endphp

<div class="pay-page px-4 md:px-6 lg:px-10">
    <div class="max-w-5xl mx-auto">

        {{-- Step Bar --}}
        <div class="step-bar">
            <a href="{{ route('booking.index') }}" class="step-dot" style="background:rgba(0,166,81,0.15);color:var(--accent);">1</a>
            <div class="step-line" style="background:var(--accent);"></div>
            <div class="step-dot" style="background:var(--accent);color:#000;">2</div>
        </div>

        {{-- Back Link --}}
        <a href="{{ route('booking.index') }}" class="back-link mb-6 block">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
            </svg>
            Change Selections
        </a>

        {{-- Page Title --}}
        <div class="mb-8">
            <span class="text-xs font-black uppercase tracking-[0.3em]" style="color:var(--accent);">Step 2 of 2</span>
            <h1 class="text-3xl md:text-5xl font-black tracking-tighter leading-none mt-1" style="color:var(--text-main);">
                Your Details &
                <span style="-webkit-text-stroke:1.5px var(--accent);color:transparent;">Payment</span>
            </h1>
        </div>

        @if(session('error'))
        <div class="mb-6 p-4 rounded-2xl flex items-center gap-3" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);">
            <svg class="w-5 h-5 shrink-0 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-sm font-bold text-red-400">{{ session('error') }}</span>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            {{-- LEFT: Order Summary --}}
            <div class="lg:col-span-2">
                <div class="sticky top-28 space-y-4">

                    {{-- Summary Card --}}
                    <div class="pay-card" style="border-top: 3px solid var(--accent);">
                        <h2 class="font-black text-sm uppercase tracking-widest mb-4 flex items-center gap-2" style="color:var(--text-main);">
                            <svg class="w-4 h-4" style="color:var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            Order Summary
                        </h2>

                        <div class="mb-4">
                            @foreach($items as $item)
                            <div class="order-row">
                                <div style="color:var(--text-muted);">
                                    <span class="font-semibold" style="color:var(--text-main);">{{ $item['name'] }}</span>
                                    @if($item['quantity'] > 1)
                                        <span class="text-[10px] font-black ml-1" style="color:var(--accent);">×{{ $item['quantity'] }}</span>
                                    @endif
                                </div>
                                <div class="font-bold shrink-0" style="color:var(--text-main);">
                                    RM{{ number_format($item['price'] * $item['quantity'], 0) }}
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="pt-3" style="border-top:2px solid var(--glass-border);">
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-black uppercase tracking-widest" style="color:var(--text-muted);">Total Est.</span>
                                <span class="text-2xl font-black" style="color:var(--accent);">RM{{ number_format($totalPrice, 0) }}</span>
                            </div>
                            <p class="text-[9px] mt-1 italic font-bold" style="color:var(--text-muted);">Inc. SST • Final price confirmed after site survey</p>
                        </div>
                    </div>

                    {{-- Date Card --}}
                    <div class="pay-card">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0" style="background:rgba(0,166,81,0.12);">
                                <svg class="w-5 h-5" style="color:var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[9px] font-black uppercase tracking-widest" style="color:var(--text-muted);">Preferred Installation Date</p>
                                <p class="text-sm font-bold mt-0.5" style="color:var(--text-main);">{{ $formattedDate }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Trust Badges --}}
                    <div class="pay-card">
                        <div class="space-y-2.5">
                            @foreach([
                                ['icon'=>'🔒','text'=>'Secure & encrypted booking'],
                                ['icon'=>'✅','text'=>'Confirmed via WhatsApp within 24h'],
                                ['icon'=>'🛡️','text'=>'Licensed & insured installation team'],
                                ['icon'=>'💸','text'=>'Transparent pricing, no hidden fees'],
                            ] as $badge)
                            <div class="flex items-center gap-2.5 text-xs" style="color:var(--text-muted);">
                                <span class="text-base leading-none">{{ $badge['icon'] }}</span>
                                <span>{{ $badge['text'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

            {{-- RIGHT: Details Form --}}
            <div class="lg:col-span-3">
                <div class="pay-card">
                    <form action="{{ route('booking.store') }}" method="POST" x-data="{ payMethod: 'whatsapp' }" class="space-y-5">
                        @csrf

                        {{-- Honeypot --}}
                        <div style="display:none;">
                            <input type="text" name="_website_url" tabindex="-1" autocomplete="off">
                        </div>

                        {{-- Hidden fields from draft --}}
                        <input type="hidden" name="preferred_date" value="{{ $prefDate }}">
                        @foreach($items as $i => $item)
                            <input type="hidden" name="items[{{ $i }}][id]" value="{{ $item['id'] }}">
                            <input type="hidden" name="items[{{ $i }}][quantity]" value="{{ $item['quantity'] }}">
                        @endforeach
                        <input type="hidden" name="payment_method" x-model="payMethod">

                        {{-- Section: Personal Details --}}
                        <div>
                            <h3 class="text-sm font-black uppercase tracking-widest mb-4 flex items-center gap-2" style="color:var(--text-main);">
                                <svg class="w-4 h-4" style="color:var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Personal Details
                            </h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="text-[10px] font-black uppercase tracking-widest block mb-1.5" style="color:var(--text-muted);">Full Name *</label>
                                    <input type="text" name="customer_name" class="pay-input" placeholder="e.g. Ahmad bin Abdullah"
                                        required value="{{ old('customer_name') }}">
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="text-[10px] font-black uppercase tracking-widest block mb-1.5" style="color:var(--text-muted);">WhatsApp Number *</label>
                                        <input type="tel" name="phone_number" class="pay-input" placeholder="e.g. 0123456789"
                                            required value="{{ old('phone_number') }}">
                                    </div>
                                    <div>
                                        <label class="text-[10px] font-black uppercase tracking-widest block mb-1.5" style="color:var(--text-muted);">Email Address *</label>
                                        <input type="email" name="email" class="pay-input" placeholder="you@email.com"
                                            required value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div>
                                    <label class="text-[10px] font-black uppercase tracking-widest block mb-1.5" style="color:var(--text-muted);">Installation Address *</label>
                                    <textarea name="address" class="pay-input" placeholder="Full address including unit no., postcode & state..."
                                        rows="3" required>{{ old('address') }}</textarea>
                                </div>
                                <div>
                                    <label class="text-[10px] font-black uppercase tracking-widest block mb-1.5" style="color:var(--text-muted);">Additional Notes (Optional)</label>
                                    <textarea name="notes" class="pay-input" placeholder="Any special requirements or access instructions..."
                                        rows="2">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Section: Payment Method --}}
                        <div style="border-top:1px solid var(--glass-border);padding-top:1.5rem;">
                            <h3 class="text-sm font-black uppercase tracking-widest mb-4 flex items-center gap-2" style="color:var(--text-main);">
                                <svg class="w-4 h-4" style="color:var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                                Payment Method
                            </h3>
                            <div class="space-y-3">

                                {{-- FPX / Online Banking --}}
                                <div class="pay-method" :class="payMethod === 'fpx' ? 'pay-method--selected' : ''" @click="payMethod = 'fpx'">
                                    <div class="pay-radio" :class="payMethod === 'fpx' ? 'pay-radio--selected' : ''"></div>
                                    <div class="flex-1">
                                        <p class="text-sm font-bold" style="color:var(--text-main);">Online Banking (FPX)</p>
                                        <p class="text-[10px]" style="color:var(--text-muted);">Maybank, CIMB, RHB, Public Bank & more</p>
                                    </div>
                                    <div class="flex gap-1.5 flex-wrap justify-end">
                                        @foreach(['MB', 'CB', 'RH', 'PB'] as $bank)
                                        <span class="text-[9px] font-black px-1.5 py-0.5 rounded" style="background:var(--glass);color:var(--text-muted);">{{ $bank }}</span>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Credit / Debit Card --}}
                                <div class="pay-method" :class="payMethod === 'card' ? 'pay-method--selected' : ''" @click="payMethod = 'card'">
                                    <div class="pay-radio" :class="payMethod === 'card' ? 'pay-radio--selected' : ''"></div>
                                    <div class="flex-1">
                                        <p class="text-sm font-bold" style="color:var(--text-main);">Credit / Debit Card</p>
                                        <p class="text-[10px]" style="color:var(--text-muted);">Visa, Mastercard — secure 3D payment</p>
                                    </div>
                                    <div class="flex gap-1.5">
                                        <span class="text-[9px] font-black px-1.5 py-0.5 rounded" style="background:rgba(30,86,160,0.15);color:#1e56a0;">VISA</span>
                                        <span class="text-[9px] font-black px-1.5 py-0.5 rounded" style="background:rgba(235,0,27,0.1);color:#eb001b;">MC</span>
                                    </div>
                                </div>

                                {{-- WhatsApp / Confirm Later --}}
                                <div class="pay-method" :class="payMethod === 'whatsapp' ? 'pay-method--selected' : ''" @click="payMethod = 'whatsapp'">
                                    <div class="pay-radio" :class="payMethod === 'whatsapp' ? 'pay-radio--selected' : ''"></div>
                                    <div class="flex-1">
                                        <p class="text-sm font-bold" style="color:var(--text-main);">Confirm via WhatsApp</p>
                                        <p class="text-[10px]" style="color:var(--text-muted);">Our team will contact you to arrange payment</p>
                                    </div>
                                    <svg class="w-5 h-5 shrink-0" style="color:#25d366;" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                    </svg>
                                </div>

                            </div>

                            {{-- FPX/Card note --}}
                            <p class="text-[9px] mt-3 font-medium" style="color:var(--text-muted);"
                                x-show="payMethod === 'fpx' || payMethod === 'card'">
                                ⚡ You'll be redirected to our secure payment gateway after submitting.
                            </p>
                            <p class="text-[9px] mt-3 font-medium" style="color:var(--text-muted);"
                                x-show="payMethod === 'whatsapp'">
                                📱 Our team will contact you via WhatsApp within 24 hours to confirm and arrange payment.
                            </p>
                        </div>

                        {{-- Errors --}}
                        @if($errors->any())
                        <div class="p-4 rounded-xl text-xs space-y-1" style="background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.2);">
                            @foreach($errors->all() as $error)
                                <p style="color:#ef4444;">• {{ $error }}</p>
                            @endforeach
                        </div>
                        @endif

                        {{-- Submit --}}
                        <button type="submit" class="submit-btn">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <span x-text="payMethod === 'whatsapp' ? 'Confirm Booking' : 'Proceed to Payment'"></span>
                        </button>

                        <p class="text-[9px] text-center font-medium" style="color:var(--text-muted);">
                            By submitting, you agree to our
                            <a href="{{ route('terms') }}" class="underline" style="color:var(--accent);">Terms of Service</a>.
                        </p>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
