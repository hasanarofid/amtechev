<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @if(config('analytics.gtm_id'))
        <!-- Google Tag Manager -->
        <script>(function (w, d, s, l, i) {
                w[l] = w[l] || []; w[l].push({
                    'gtm.start':
                        new Date().getTime(), event: 'gtm.js'
                }); var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                        'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', '{{ config('analytics.gtm_id') }}');</script>
        <!-- End Google Tag Manager -->
    @endif

    <title>@yield('title', 'AMTECH EV Specialist') – Best Value EV Charging Solutions in Malaysia</title>

    <link rel="icon" type="image/png" href="{{ asset('logo/amtech-removebg.png') }}">

    <!-- SEO & Meta Tags -->
    <meta name="description"
        content="@yield('meta_description', 'AMTECH EV Specialist – Best Value EV Charging Solutions in Malaysia. Expert installation and high-quality EV chargers for your home and business.')">
    <meta name="keywords"
        content="@yield('meta_keywords', 'EV charger installation, Home EV charger installation, Home wallbox installation, EV charger installer, Residential EV charger installation, Wallbox charger installation, Home EV charging, Type 2 EV charger, 7kW EV charger, 11kW EV charger, 22kW EV charger, BYD charger installation, Tesla charger installation, Proton e.MAS charger installation, XPENG charger installation, Mercedes EV charger installation, BMW EV charger installation, EV charger installation Malaysia, EV charger installation Selangor, EV charger installation Kuala Lumpur, EV charger installation Johor, EV charger installation Penang, EV charger installation Negeri Sembilan, EV charger installation Melaka, EV charger installation Perak, Home EV charging solution')">
    <meta name="author" content="AMTECH EV Specialist">
    <meta name="geo.region" content="MY">
    <meta name="geo.placename" content="Malaysia">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'AMTECH EV Specialist')">
    <meta property="og:description"
        content="@yield('meta_description', 'AMTECH EV Specialist – Best Value EV Charging Solutions in Malaysia.')">
    <meta property="og:image" content="@yield('og_image', asset('logo/logo.png'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'AMTECH EV Specialist')">
    <meta property="twitter:description"
        content="@yield('meta_description', 'AMTECH EV Specialist – Best Value EV Charging Solutions in Malaysia.')">
    <meta property="twitter:image" content="@yield('og_image', asset('logo/logo.png'))">

    <!-- AdSense Script -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7190047001129861"
        crossorigin="anonymous"></script>
    <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8508864005334643" crossorigin="anonymous"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7011966334577062" crossorigin="anonymous"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8237299120114346" crossorigin="anonymous"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5709110142652608" crossorigin="anonymous"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3062961177229879" crossorigin="anonymous"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7455450035069511" crossorigin="anonymous"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5691921194850520" crossorigin="anonymous"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7688754553227611" crossorigin="anonymous"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9415971124543697" crossorigin="anonymous"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9579252174385982" crossorigin="anonymous"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2605686450254852" crossorigin="anonymous"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5220108335483541" crossorigin="anonymous"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3822831682952018" crossorigin="anonymous"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9603353140790411" crossorigin="anonymous"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3043056973934455" crossorigin="anonymous"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2267794952392779" crossorigin="anonymous"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1217506959699866" crossorigin="anonymous"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8084033310853758" crossorigin="anonymous"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2266174054387048" crossorigin="anonymous"></script>
     -->
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // Check local storage for theme preference or system preference
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            document.documentElement.setAttribute('data-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            document.documentElement.setAttribute('data-theme', 'light');
        }
    </script>


    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        .hero-bg {
            background-image:
                linear-gradient(to bottom, rgba(3, 3, 3, 0.7) 0%, rgba(3, 3, 3, 0.4) 50%, rgba(3, 3, 3, 0.9) 100%),
                url("{{ (isset($settings['hero_image']) && $settings['hero_image']) ? (Str::startsWith($settings['hero_image'], 'settings/') ? asset('storage/' . $settings['hero_image']) : asset($settings['hero_image'])) : asset('technical_analysis.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .btn-ev {
            padding: 1rem 2.5rem;
            background-color: #22c55e;
            color: #000;
            font-weight: 900;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.15em;
            border-radius: 9999px;
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            box-shadow: 0 10px 30px rgba(34, 197, 94, 0.4);
            display: inline-block;
        }

        .ev-card {
            background-color: #0a0a0a;
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 2.5rem;
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .glassmorphism {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .text-ev-green {
            color: #22c55e;
        }

        .bg-ev-green {
            background-color: #22c55e;
        }

        .font-outline-2 {
            -webkit-text-stroke: 1px currentColor;
            -webkit-text-fill-color: transparent;
        }

        @keyframes reveal {
            from {
                opacity: 0;
                transform: translateY(30px);
                filter: blur(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
                filter: blur(0);
            }
        }

        .animate-reveal {
            animation: reveal 1.2s cubic-bezier(0.23, 1, 0.32, 1) forwards;
        }
    </style>
    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    @stack('styles')
    @stack('head')
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-18308241649"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'AW-18308241649');
    </script>
</head>

<body
    class="antialiased overflow-x-hidden selection:bg-ev-green selection:text-white dark:selection:text-black bg-gray-50 dark:bg-[#030303] text-gray-900 dark:text-white transition-colors duration-300">
    @if(config('analytics.gtm_id'))
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ config('analytics.gtm_id') }}" height="0"
                width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endif

    @include('frontend.header')

    <main>
        @yield('content')
    </main>

    @include('frontend.footer')

    <!-- Flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if the URL contains Google Ads info (gclid or utm_source=google)
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('gclid') || urlParams.get('utm_source') === 'google') {
                // Change all WhatsApp button hrefs to include the Google Ads specific message
                const waButtons = document.querySelectorAll('a[href^="https://wa.me"]');
                waButtons.forEach(btn => {
                    try {
                        let url = new URL(btn.href);
                        url.searchParams.set('text', 'Hi, I interested to install ev charger from Google Ads.');
                        btn.href = url.toString();
                    } catch (e) {
                        console.error('Error parsing WA URL', e);
                    }
                });
            }
        });
    </script>

    @stack('scripts')
</body>

</html>