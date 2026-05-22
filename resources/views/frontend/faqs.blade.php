@extends('frontend.layouts.app')

@section('title', 'Frequently Asked Questions – Amtech EV Specialist')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-32">
    <div class="text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-black text-gray-900 dark:text-white mb-6 tracking-tighter uppercase italic">
            Frequently Asked <span class="text-ev-green">Questions</span>
        </h1>
        <p class="text-lg text-gray-600 dark:text-gray-400">
            Got questions about EV chargers or our installation process? We've got answers.
        </p>
    </div>

    <div class="space-y-6">
        <!-- FAQ Item 1 -->
        <div class="bg-white dark:bg-[#0a0a0a] border border-gray-200 dark:border-white/10 rounded-2xl p-6 shadow-sm">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">What is the difference between Level 1 and Level 2 charging?</h3>
            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                Level 1 charging uses a standard 120V household outlet and provides about 3-5 miles of range per hour. It's very slow. Level 2 charging uses a 240V circuit (like an oven or dryer) and can provide 12-80 miles of range per hour, making it ideal for home and business installations. We specialize in Level 2 and DC Fast Chargers.
            </p>
        </div>

        <!-- FAQ Item 2 -->
        <div class="bg-white dark:bg-[#0a0a0a] border border-gray-200 dark:border-white/10 rounded-2xl p-6 shadow-sm">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">Do I need to upgrade my electrical panel?</h3>
            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                It depends on your current electrical panel's capacity and the charger you choose. A Level 2 charger typically requires a dedicated 40 to 60-amp circuit. Our certified technicians will assess your electrical system during the consultation and advise if an upgrade is necessary.
            </p>
        </div>

        <!-- FAQ Item 3 -->
        <div class="bg-white dark:bg-[#0a0a0a] border border-gray-200 dark:border-white/10 rounded-2xl p-6 shadow-sm">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">How long does an installation usually take?</h3>
            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                Most standard residential installations take between 2 to 4 hours. However, this can vary based on the distance from your electrical panel to the charging location, the complexity of the cable routing, and whether any panel upgrades are needed.
            </p>
        </div>

        <!-- FAQ Item 4 -->
        <div class="bg-white dark:bg-[#0a0a0a] border border-gray-200 dark:border-white/10 rounded-2xl p-6 shadow-sm">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">Are your chargers weatherproof?</h3>
            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                Yes, the majority of the chargers we install have high IP ratings (such as IP54 or IP65), meaning they are designed to withstand dust and rain. They can be safely installed both indoors (like in a garage) and outdoors.
            </p>
        </div>
        
        <!-- FAQ Item 5 -->
        <div class="bg-white dark:bg-[#0a0a0a] border border-gray-200 dark:border-white/10 rounded-2xl p-6 shadow-sm">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">What areas do you serve?</h3>
            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                We primarily serve the Klang Valley and surrounding areas in Malaysia. If you are located outside this region, please contact us, and we will do our best to accommodate your request or connect you with a trusted partner.
            </p>
        </div>
    </div>
    
    <div class="mt-16 text-center">
        <p class="text-gray-600 dark:text-gray-400 mb-6">Still have questions?</p>
        <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-black bg-ev-green hover:bg-green-400 transition-colors shadow-lg shadow-ev-green/20">
            Contact Us
        </a>
    </div>
</div>
@endsection
