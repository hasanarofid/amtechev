@extends('frontend.layouts.app')

@section('title', 'About Us – Amtech EV Specialist')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-32">
    <div class="text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-black text-gray-900 dark:text-white mb-6 tracking-tighter uppercase italic">
            About <span class="text-ev-green">Amtech EV Specialist</span>
        </h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
            Leading the charge in Malaysia's EV revolution by providing premium, reliable, and accessible EV charging solutions for homes and businesses.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-24">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 uppercase tracking-widest border-l-4 border-ev-green pl-4">Our Mission</h2>
            <p class="text-gray-600 dark:text-gray-300 leading-relaxed mb-6">
                At Amtech EV Specialist, our mission is to accelerate the transition to sustainable energy by making EV charging infrastructure more accessible, reliable, and user-friendly. We understand that range anxiety and charging convenience are major hurdles for EV adoption, which is why we are dedicated to bringing top-tier charging solutions right to your doorstep.
            </p>
            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                Whether you are a homeowner looking for a smart charger or a business aiming to provide value to your customers and employees, our team of certified professionals ensures seamless installation, comprehensive support, and the highest safety standards in every project.
            </p>
        </div>
        <div class="bg-gray-100 dark:bg-[#0a0a0a] p-8 rounded-3xl border border-gray-200 dark:border-white/5 shadow-lg">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 uppercase tracking-widest text-center">Why Choose Us?</h3>
            <ul class="space-y-4">
                <li class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full bg-ev-green/20 text-ev-green flex items-center justify-center flex-shrink-0 mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 dark:text-white">Expert Installation</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Our technicians are highly trained and certified in electrical installations specifically for EV chargers.</p>
                    </div>
                </li>
                <li class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full bg-ev-green/20 text-ev-green flex items-center justify-center flex-shrink-0 mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 dark:text-white">Safety First</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">We never compromise on safety. All our installations strictly adhere to national electrical codes and safety guidelines.</p>
                    </div>
                </li>
                <li class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full bg-ev-green/20 text-ev-green flex items-center justify-center flex-shrink-0 mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 dark:text-white">Premium Quality</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">We partner with leading brands to provide chargers that are durable, smart, and future-proof.</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
