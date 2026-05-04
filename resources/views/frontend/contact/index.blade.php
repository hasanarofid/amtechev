@extends('frontend.layouts.app')

@section('title', 'Contact Us – ' . ($settings['site_title'] ?? 'AMTECH EV Specialist'))

@push('styles')
<style>
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
    .contact-form-section { padding: 80px 0; }
    .contact-info-section { background-color: #0d0d0d; color: #ffffff; padding: 100px 0; }
    .input-ev { width: 100%; padding: 14px 20px; background-color: transparent; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px; transition: all 0.3s ease; }
    .dark .input-ev { border-color: rgba(255, 255, 255, 0.1); color: white; }
    .input-ev:focus { outline: none; border-color: #22c55e; box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.1); }
    .btn-send { padding: 12px 40px; background-color: #22c55e; color: white; border-radius: 99px; font-weight: 700; transition: all 0.3s ease; }
    .btn-send:hover { background-color: #16a34a; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3); }
</style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero-contact pt-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-14 text-center">
            <!-- Space for background image focus -->
        </div>
    </section>

    <!-- Header Section -->
    <section class="py-20 text-center bg-white dark:bg-[#030303]">
        <div class="max-w-3xl mx-auto px-6">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">We're here to help</p>
            <h1 class="text-5xl font-black mb-8 dark:text-white">Connect with us!</h1>
            <p class="text-gray-500 dark:text-gray-400 leading-relaxed mb-4">
                Get in touch with the {{ $settings['site_title'] ?? 'AMTECH EV Specialist' }} team to discuss your needs, ask questions, or request a consultation. We're always here to help and look forward to connecting with you.
            </p>
            <p class="font-bold text-gray-700 dark:text-gray-300 mb-8">Whats app Us at {{ $settings['contact_phone'] ?? '+60 11-6768 6742' }}</p>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '601167686742') }}?text={{ urlencode($settings['whatsapp_bubble_text'] ?? 'Hi, I want to speak to an EV Charging Specialist') }}" target="_blank" class="inline-flex items-center gap-3 bg-[#25D366] hover:bg-[#128C7E] text-white px-8 py-4 rounded-full font-bold shadow-xl transition-all hover:scale-105 group">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                WhatsApp Us
            </a>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="contact-form-section bg-gray-50 dark:bg-white/5">
        <div class="max-w-4xl mx-auto px-6">
            @if(session('success'))
                <div class="mb-10 p-6 bg-ev-green/10 border border-ev-green/20 rounded-2xl text-ev-green font-bold text-center animate-bounce-subtle">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-10 p-6 bg-red-50 border border-red-100 rounded-2xl text-red-500 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input type="text" name="name" placeholder="Name" required class="input-ev" value="{{ old('name') }}">
                    <input type="email" name="email" placeholder="Email *" required class="input-ev" value="{{ old('email') }}">
                </div>
                <input type="tel" name="phone_number" placeholder="Phone number" class="input-ev" value="{{ old('phone_number') }}">
                <textarea name="comment" placeholder="Comment" rows="6" required class="input-ev">{{ old('comment') }}</textarea>
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
                            <a href="mailto:{{ $settings['contact_email'] ?? 'info@amtechev.com' }}" class="text-gray-300 hover:text-white transition-colors">
                                {{ $settings['contact_email'] ?? 'info@amtechev.com' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

