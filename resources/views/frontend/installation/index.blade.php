<!-- resources/views/frontend/installation/index.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Installation Services – {{ $settings['site_title'] ?? 'AMTECH EV Specialist' }}</title>
    
    <link rel="icon" type="image/png" href="{{ asset('logo/amtech-removebg.png') }}">
    
    <!-- AdSense Script -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7190047001129861" crossorigin="anonymous"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #ffffff; color: #1a1a1a; }
        .hero-installation {
            background-color: #0a0a0a;
            color: #ffffff;
            padding: 160px 0 100px;
            background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.8)), url('{{ asset('storage/ev_hero_bg_1773856111374.png') }}');
            background-size: cover;
            background-position: center;
        }
        .section-light { background-color: #f9fafb; padding: 100px 0; }
        .section-white { background-color: #ffffff; padding: 100px 0; }
        .feature-icon { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; background-color: rgba(34, 197, 94, 0.08); color: #22c55e; border-radius: 12px; margin-bottom: 24px; }
        .service-card { transition: all 0.3s ease; border: 1px solid #f3f4f6; padding: 40px; border-radius: 20px; height: 100%; }
        .service-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-color: #22c55e; }
    </style>
</head>
<body class="antialiased font-light">

    @include('frontend.header')

    <!-- Hero Section -->
    <section class="hero-installation">
        <div class="max-w-7xl mx-auto px-6 lg:px-14">
            <h1 class="text-4xl lg:text-6xl font-black mb-6 leading-tight">Professional <span class="text-ev-green">EV Charger</span><br>Installation Services</h1>
            <p class="text-gray-400 text-lg max-w-2xl mb-10 leading-relaxed font-normal">
                Ensuring safe, efficient, and compliant charging solutions for homes and businesses across Malaysia.
            </p>
            <div class="flex gap-4">
                <a href="#quote" class="px-8 py-3 bg-ev-green text-black font-bold rounded-full hover:scale-105 transition-all">Get a Free Quote</a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '601167686742') }}?text={{ urlencode($settings['whatsapp_bubble_text'] ?? 'Hi, I want to install an EV charger') }}" target="_blank" class="px-8 py-3 border border-white/20 rounded-full font-bold hover:bg-white/5 transition-all">Contact Expert</a>
            </div>
        </div>
    </section>

    <!-- Residential Charging -->
    <section class="section-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-14">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div>
                    <img src="{{ asset('storage/ev_charger_product_1773856128972.png') }}" alt="Home Charging" class="rounded-3xl shadow-xl w-full">
                </div>
                <div>
                    <div class="text-ev-green font-bold uppercase tracking-widest text-xs mb-4">Residential Solutions</div>
                    <h2 class="text-4xl font-bold mb-6">Home Charging Made Easy</h2>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Charge your vehicle from the comfort of your home with our bespoke installation services. We handle everything from site assessment to final testing.
                    </p>
                    <ul class="space-y-4 mb-10">
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-ev-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"></path></svg>
                            <span>Surge protection & safety assessment</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-ev-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"></path></svg>
                            <span>Dedicated circuit installation</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-ev-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"></path></svg>
                            <span>Compatibility with all major EV brands</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Commercial Charging -->
    <section class="section-light">
        <div class="max-w-7xl mx-auto px-6 lg:px-14">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="order-2 lg:order-1">
                    <div class="text-ev-green font-bold uppercase tracking-widest text-xs mb-4">Commercial Solutions</div>
                    <h2 class="text-4xl font-bold mb-6">Business & Public Charging</h2>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Scale your charging infrastructure with our professional commercial solutions. Perfect for office buildings, retail spaces, and public parking.
                    </p>
                    <a href="#contact" class="inline-flex items-center gap-2 font-bold text-ev-green hover:underline">
                        Learn about fleet solutions
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
                <div class="order-1 lg:order-2">
                    <img src="{{ asset('storage/ev_hero_bg_1773856111374.png') }}" alt="Commercial EV Charging" class="rounded-3xl shadow-xl w-full">
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="section-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-14 text-center">
            <h2 class="text-4xl font-bold mb-16">Why Choose Amtech EV?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="service-card text-left">
                    <div class="feature-icon">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold mb-4">Certified & Insured</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Our installations are performed by certified electricians and are fully insured for your peace of mind.
                    </p>
                </div>
                <div class="service-card text-left">
                    <div class="feature-icon">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold mb-4">Fast Turnaround</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        We prioritize rapid site visits and installations, ensuring you're charging as soon as possible.
                    </p>
                </div>
                <div class="service-card text-left">
                    <div class="feature-icon">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold mb-4">Ongoing Support</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Enjoy peace of mind with our dedicated maintenance packages and 24/7 emergency support.
                    </p>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.footer')

</body>
</html>
