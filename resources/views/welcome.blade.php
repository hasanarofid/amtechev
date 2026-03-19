<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Amtech EV Specialist – Leading EV Charging Solutions in Malaysia</title>
    
    <!-- SEO -->
    <meta name="description" content="Amtech EV Specialist makes EV charging accessible in Malaysia with high-quality products and services for homes and businesses. Today, enjoy seamless charging!">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #0a0a0a; color: #ffffff; }
        .hero-bg {
            background-image: linear-gradient(rgba(10, 10, 10, 0.7), rgba(10, 10, 10, 0.9)), url('/storage/ev_hero_bg_1773856111374.png');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="antialiased overflow-x-hidden">

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 w-full z-50 px-6 lg:px-14 py-6 flex justify-between items-center bg-black/50 backdrop-blur-lg border-b border-white/10">
        <div class="flex items-center gap-3">
            <img src="/logo/amtech-removebg.png" alt="Amtech EV Logo" class="h-10 w-auto">
            <h1 class="text-xl font-bold tracking-tight hidden md:block">AMTECH <span class="text-ev-green italic tracking-tighter">EV</span></h1>
        </div>
        
        <div class="hidden md:flex gap-8 text-sm font-semibold uppercase tracking-wider text-gray-300">
            <a href="#services" class="hover:text-ev-green transition-colors">Services</a>
            <a href="#products" class="hover:text-ev-green transition-colors">Chargers</a>
            <a href="#installations" class="hover:text-ev-green transition-colors">Installations</a>
            <a href="#contact" class="hover:text-ev-green transition-colors">Contact</a>
        </div>

        <div class="flex items-center gap-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-ev">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition-colors uppercase text-xs font-bold tracking-widest">Login</a>
                @endauth
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center pt-24 hero-bg overflow-hidden">
        <div class="ev-hero-gradient absolute inset-0 pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-14 relative z-10 w-full">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-ev-green/10 border border-ev-green/20 rounded-full mb-8">
                    <span class="w-2 h-2 bg-ev-green rounded-full animate-pulse-green"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-ev-green">Malaysia's #1 EV Solutions</span>
                </div>
                <h2 class="text-5xl lg:text-7xl font-extrabold tracking-tight mb-6 leading-tight">
                    Malaysia's <span class="text-ev-green">Electric Vehicle</span><br>Charger Specialist
                </h2>
                <p class="text-lg text-gray-300 mb-10 max-w-xl leading-relaxed">
                    Amtech EV makes EV charging accessible in Malaysia with high-quality products and services for homes and businesses. Experience the future of mobility today.
                </p>
                <div class="flex flex-wrap gap-6">
                    <a href="#products" class="btn-ev px-10 py-4">Explore Chargers</a>
                    <a href="#contact" class="px-10 py-4 border border-white/20 rounded-full font-bold hover:bg-white/5 transition-all text-sm uppercase tracking-widest">Consult Now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Info Section -->
    <section class="py-20 bg-black">
        <div class="max-w-7xl mx-auto px-6 lg:px-14">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                @foreach([
                    ['title' => 'Highest Quality Charger', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['title' => 'Quick Installations', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                    ['title' => 'EV Spare Parts', 'icon' => 'M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a1 1 0 01-1-1v-3a1 1 0 011-1h1a2 2 0 100-4H4a1 1 0 01-1-1V7a1 1 0 011-1h3a1 1 0 011 1v1a2 2 0 114 0V4z'],
                    ['title' => 'Eco-Friendly Solutions', 'icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z']
                ] as $info)
                <div class="flex flex-col items-center text-center group">
                    <div class="w-16 h-16 bg-ev-green/10 border border-ev-green/20 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-ev-green group-hover:text-black transition-all">
                        <svg class="w-8 h-8 text-ev-green group-hover:text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $info['icon'] }}"></path></svg>
                    </div>
                    <h4 class="text-sm font-bold uppercase tracking-widest">{{ $info['title'] }}</h4>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Empower Section -->
    <section id="services" class="py-32 bg-ev-dark overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-14">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="relative">
                    <div class="absolute -inset-4 bg-ev-green/20 blur-3xl rounded-full"></div>
                    <img src="{{ asset('storage/ev_charger_product_1773856128972.png') }}" alt="EV Charger" class="relative rounded-3xl border border-white/10 shadow-2xl">
                </div>
                <div>
                    <h3 class="text-ev-green font-bold uppercase tracking-[0.3em] mb-4 text-sm">Empower Your EV Journey</h3>
                    <h2 class="text-4xl lg:text-5xl font-bold mb-8 leading-tight">Reliable & Smart 🔌 Charging Solution</h2>
                    <p class="text-gray-400 text-lg leading-relaxed mb-10 font-light">
                        Investing in an EV charging station for your home or business is more than just about charging; it's about convenience, cost-efficiency, and contributing to a greener future.
                    </p>
                    <div class="space-y-6">
                        @foreach(['Home Charging', 'Commercial Solutions', 'Maintenance Services'] as $item)
                        <div class="flex items-center gap-4">
                            <div class="w-6 h-6 bg-ev-green/20 rounded-full flex items-center justify-center">
                                <svg class="text-ev-green w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="font-semibold text-gray-200">{{ $item }}</span>
                        </div>
                        @endforeach
                    </div>
                    <a href="#contact" class="inline-block mt-12 btn-ev">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Chargers -->
    <section id="products" class="py-32 bg-black">
        <div class="max-w-7xl mx-auto px-6 lg:px-14 text-center">
            <h3 class="text-ev-green font-bold uppercase tracking-[0.3em] mb-4 text-sm">Our Selection</h3>
            <h2 class="text-4xl lg:text-6xl font-black mb-20 uppercase">Featured <span class="italic text-ev-green">Chargers</span></h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach([
                    ['name' => '11kw Home E1 EV Charger', 'price' => 'RM 2,499'],
                    ['name' => 'Teltonika 22kw Home EV Charger', 'price' => 'RM 4,200'],
                    ['name' => '7kw Home E1 EV Charger', 'price' => 'RM 1,899']
                ] as $charger)
                <div class="ev-card p-10 flex flex-col items-center">
                    <img src="{{ asset('storage/ev_charger_product_1773856128972.png') }}" alt="{{ $charger['name'] }}" class="w-48 h-48 object-contain mb-8 ev-glow">
                    <h4 class="text-xl font-bold mb-2">{{ $charger['name'] }}</h4>
                    <span class="text-ev-green font-bold text-lg mb-8">{{ $charger['price'] }}</span>
                    <a href="#" class="px-8 py-3 border border-white/10 rounded-full text-xs font-bold uppercase tracking-widest hover:border-ev-green hover:text-ev-green transition-all w-full">View Details</a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Brands Section -->
    <section class="py-32 bg-ev-dark border-y border-white/5">
        <div class="max-w-7xl mx-auto px-6 lg:px-14 text-center">
            <h3 class="text-gray-500 font-bold uppercase tracking-[0.3em] mb-12 text-sm italic">FOR EVERY BRAND & MODEL</h3>
            <div class="grid grid-cols-2 md:grid-cols-6 gap-8 opacity-30 grayscale hover:grayscale-0 transition-all duration-700">
                @for($i=0; $i<12; $i++)
                <div class="h-12 bg-white/10 rounded-lg flex items-center justify-center text-[10px] font-bold uppercase tracking-widest">BRAND {{ $i+1 }}</div>
                @endfor
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-32 bg-black overflow-hidden border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 lg:px-14">
            <div class="text-center mb-20">
                <div class="flex justify-center gap-1 mb-6">
                    @for($i=0; $i<5; $i++)
                        <svg class="w-5 h-5 text-ev-green fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    @endfor
                </div>
                <h2 class="text-3xl lg:text-5xl font-bold mb-4 italic">EVSifu reviews from owners and experts</h2>
                <p class="text-gray-500 uppercase tracking-widest text-sm font-bold">EXPERIENCE THE EV SIFU DIFFERENCE TODAY</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach([
                    'The installation was incredibly fast and the team was very professional. Highly recommend Amtech EV for home charging!',
                    'Top-notch service and the charger works perfectly with my Tesla. The green glow looks amazing in my garage!',
                    'Great support and advice on choosing the right charger. The maintenance service is also very reliable.'
                ] as $testimonial)
                <div class="ev-card p-10">
                    <p class="text-gray-300 italic mb-8 leading-relaxed">"{{ $testimonial }}"</p>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-ev-green/20 rounded-full"></div>
                        <div>
                            <p class="font-bold text-sm">Happy Customer</p>
                            <p class="text-xs text-gray-500">Verified Owner</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Blog / News Section -->
    <section id="blog" class="py-32 bg-ev-dark border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 lg:px-14">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
                <div>
                    <h3 class="text-ev-green font-bold uppercase tracking-[0.3em] mb-4 text-sm">Insights</h3>
                    <h2 class="text-4xl lg:text-6xl font-black uppercase">Curious to <span class="italic text-ev-green">learn more?</span></h2>
                </div>
                <a href="#" class="btn-ev px-8 py-3 text-sm">View All Posts</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach([
                    ['title' => 'Best Home EV Charger Malaysia 2026 — Complete Buyer\'s Guide', 'image' => '/storage/ev_hero_bg_1773856111374.png'],
                    ['title' => 'Malacca Emerges as Malaysia’s EV Manufacturing Hub', 'image' => '/storage/ev_hero_bg_1773856111374.png'],
                    ['title' => 'Analysis on EV Charger Components', 'image' => '/storage/ev_hero_bg_1773856111374.png']
                ] as $post)
                <div class="group cursor-pointer">
                    <div class="relative aspect-video rounded-3xl overflow-hidden mb-8 border border-white/5">
                        <img src="{{ asset($post['image']) }}" alt="{{ $post['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                    <h4 class="text-xl font-bold leading-tight group-hover:text-ev-green transition-colors">{{ $post['title'] }}</h4>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black py-24 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 lg:px-14">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-16 mb-20">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-3 mb-8">
                        <img src="/logo/amtech-removebg.png" alt="Amtech EV Logo" class="h-10 w-auto">
                        <h1 class="text-3xl font-bold tracking-tight">AMTECH <span class="text-ev-green italic tracking-tighter">EV</span></h1>
                    </div>
                    <p class="text-gray-400 max-w-sm leading-relaxed">
                        Leading the charge in Malaysia's EV revolution. Quality, reliability, and innovation in every connection.
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-bold uppercase tracking-widest mb-8">Quick Links</h4>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-ev-green">About Us</a></li>
                        <li><a href="#" class="hover:text-ev-green">Services</a></li>
                        <li><a href="#" class="hover:text-ev-green">Chargers</a></li>
                        <li><a href="#" class="hover:text-ev-green">FAQs</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold uppercase tracking-widest mb-8">Get Connected</h4>
                    <p class="text-sm text-gray-400 mb-6">No 1, Jalan Amtech EV, 50000 Kuala Lumpur</p>
                    <a href="mailto:hello@amtechev.com" class="text-ev-green font-bold">hello@amtechev.com</a>
                </div>
            </div>
            <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-xs text-gray-500 uppercase tracking-widest">&copy; 2026 Amtech EV Malaysia. All rights reserved.</p>
                <div class="flex gap-8 text-[10px] font-bold uppercase tracking-widest text-gray-500">
                    <a href="#" class="hover:text-white">Privacy Policy</a>
                    <a href="#" class="hover:text-white">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
