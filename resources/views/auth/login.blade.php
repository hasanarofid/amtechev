@php
    $isAdmin = request()->query('role') === 'admin' || str_contains(url()->previous(), '/admin');
    $background = $isAdmin ? asset('bg/admin-login.png') : asset('bg/member-login.png');
    $titleText = $isAdmin ? 'ADMIN ACCESS' : 'MEMBER ACCESS';
    $subTitleText = $isAdmin ? 'Enter administrative credentials' : 'Please enter your credentials to continue';
@endphp

<x-guest-layout :background="$background">
    <x-slot:title>{{ $isAdmin ? 'Admin' : 'Member' }} Login</x-slot:title>
    <div class="mb-4">
        <h2 class="text-xl font-bold {{ $isAdmin ? 'text-accent' : 'text-main' }}">{{ $titleText }}</h2>
        <p class="text-[10px] text-text-muted uppercase font-black tracking-[0.2em] mt-1">{{ $subTitleText }}</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-2">Email Address</label>
            <input id="email" class="premium-input @error('email') border-red-500 @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-[10px] uppercase font-bold text-red-400" />
        </div>

        <!-- Password -->
        <div>
            <div class="relative" x-data="{ show: false }">
                <input id="password" class="premium-input pr-12 @error('password') border-red-500 @enderror"
                                :type="show ? 'text' : 'password'"
                                name="password"
                                required autocomplete="current-password" placeholder="••••••••" />
                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-accent focus:outline-none transition-colors">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.644C3.399 8.049 8 4 12 4s8.601 4.049 9.964 8.322a1.012 1.012 0 010 .644C20.601 15.951 16 20 12 20s-8.601-4.049-9.964-8.322z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 20 12 20c1.912 0 3.685-.604 5.12-1.632M17.644 17.644l-11.288-11.288m1.407-1.407A10.477 10.477 0 0112 4c4.756 0 8.774 3.662 10.065 8a10.477 10.477 0 01-2.046 3.774M9.414 9.414a3 3 0 114.242 4.242" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-[10px] uppercase font-bold text-red-400" />
        </div>

        <!-- Remember Me -->
        <div class="block">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded bg-glass border-glass-border text-accent focus:ring-accent/20 transition-all" name="remember">
                <span class="ms-2 text-xs text-text-muted group-hover:text-main transition-colors">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="pt-4 border-t border-glass-border">
            <button type="submit" class="btn-premium w-full py-4 text-sm tracking-widest font-black">
                LOG IN
            </button>
        </div>
    </form>
</x-guest-layout>
