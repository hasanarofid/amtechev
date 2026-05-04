@extends('frontend.layouts.app')

@section('title', ($settings['site_title'] ?? 'AMTECH EV Specialist') . ' – Best Value EV Charging Solutions in Malaysia')

@push('styles')
<style>
    .hero-bg {
        background-image: 
            linear-gradient(to bottom, rgba(3, 3, 3, 0.7) 0%, rgba(3, 3, 3, 0.4) 50%, rgba(3, 3, 3, 0.9) 100%),
            url("{{ (isset($settings['hero_image']) && $settings['hero_image']) ? (Str::startsWith($settings['hero_image'], 'settings/') ? asset('storage/' . $settings['hero_image']) : asset($settings['hero_image'])) : asset('technical_analysis.jpg') }}");
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    
    .btn-ev:hover {
        background-color: #ffffff;
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 20px 40px rgba(255, 255, 255, 0.2);
    }
    .ev-card:hover {
        border-color: rgba(34, 197, 94, 0.3);
        transform: translateY(-1rem);
        background-color: #111111;
    }
    .ev-hero-gradient {
        background: 
            radial-gradient(circle at 20% 30%, rgba(34, 197, 94, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(34, 197, 94, 0.05) 0%, transparent 50%);
    }
    .ev-glow {
        filter: drop-shadow(0 0 15px rgba(34, 197, 94, 0.4));
    }
    .bg-ev-dark { background-color: #050505; }
    
    .animation-delay-200 { animation-delay: 200ms; }
    .animation-delay-400 { animation-delay: 400ms; }
    .animation-delay-600 { animation-delay: 600ms; }

    @keyframes pulse-green {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.2); }
    }
    .animate-pulse-green {
        animation: pulse-green 2s infinite;
    }
</style>
@endpush

@section('content')
    @include('frontend.hero')
    @include('frontend.about')
    @include('frontend.services')
    @include('frontend.quality')
    @include('frontend.products')
    @include('frontend.gallery')
    @include('frontend.mission')
    @include('frontend.brands')
    @include('frontend.testimonials')
    @include('frontend.video-testimonials')
    @include('frontend.blog')
@endsection

