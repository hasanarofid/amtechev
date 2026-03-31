<!-- resources/views/frontend/contact/index.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us – {{ $settings['site_title'] ?? 'AMTECH EV Specialist' }}</title>
    
    <link rel="icon" type="image/png" href="{{ asset('logo/amtech-removebg.png') }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #ffffff; color: #1a1a1a; }
        .hero-contact {
            background-color: #0a0a0a;
            color: #ffffff;
            padding: 100px 0;
            background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url('{{ asset('storage/ev_hero_bg_1773856111374.png') }}');
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .contact-form-section { padding: 80px 0; background-color: #f9fafb; }
        .contact-info-section { background-color: #0d0d0d; color: #ffffff; padding: 100px 0; }
        .input-ev { width: 100%; padding: 14px 20px; background-color: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px; transition: all 0.3s ease; }
        .input-ev:focus { outline: none; border-color: #22c55e; box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.1); }
        .btn-send { padding: 12px 40px; background-color: #22c55e; color: white; border-radius: 99px; font-weight: 700; transition: all 0.3s ease; }
        .btn-send:hover { background-color: #16a34a; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3); }
    </style>
</head>
<body class="antialiased">

    @include('frontend.header')

    <!-- Hero Section -->
    <section class="hero-contact">
        <div class="max-w-7xl mx-auto px-6 lg:px-14 text-center">
            <!-- Space for background image focus -->
        </div>
    </section>

    <!-- Header Section -->
    <section class="py-20 text-center bg-white">
        <div class="max-w-3xl mx-auto px-6">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">We're here to help</p>
            <h1 class="text-5xl font-black mb-8">Connect with us!</h1>
            <p class="text-gray-500 leading-relaxed mb-4">
                Get in touch with the {{ $settings['site_title'] ?? 'AMTECH EV Specialist' }} team to discuss your needs, ask questions, or request a consultation. We're always here to help and look forward to connecting with you.
            </p>
            <p class="font-bold text-gray-700">Whats app Us at {{ $settings['contact_phone'] ?? '+60 11-6768 6742' }}</p>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="contact-form-section">
        <div class="max-w-4xl mx-auto px-6">
            <form action="#" method="POST" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input type="text" placeholder="Name" class="input-ev">
                    <input type="email" placeholder="Email *" required class="input-ev">
                </div>
                <input type="tel" placeholder="Phone number" class="input-ev">
                <textarea placeholder="Comment" rows="6" class="input-ev"></textarea>
                <div>
                    <button type="submit" class="btn-send">Send</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Reach Us Section -->
    <section class="contact-info-section">
        <div class="max-w-7xl mx-auto px-6 lg:px-14">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
                <div class="hidden lg:block">
                    <!-- Space or Image -->
                </div>
                <div>
                    <h2 class="text-4xl font-black mb-8 leading-tight">How to Reach Us</h2>
                    <p class="text-gray-400 mb-10 leading-relaxed">
                        We guarantee that we'll give you the <span class="text-white font-bold">best of services</span> to finalise your EV charger installation. We offer transparency in our consultation to allow for customers to better understand what goes into our scope of work during installation of the EV charger.
                    </p>
                    
                    <div class="space-y-8">
                        <div>
                            <p class="text-ev-green font-bold mb-2">Address</p>
                            <p class="text-gray-300 leading-relaxed">
                                {!! nl2br(e($settings['contact_address'] ?? "13A 22 Go Wise Box Menara Dquince Damansara Perdana\n47820 Selangor")) !!}
                            </p>
                        </div>
                        <div>
                            <p class="text-ev-green font-bold mb-2">Email</p>
                            <a href="mailto:{{ $settings['contact_email'] ?? 'enquiry@amtechev.com' }}" class="text-gray-300 hover:text-white transition-colors">
                                {{ $settings['contact_email'] ?? 'enquiry@amtechev.com' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.footer')

</body>
</html>
