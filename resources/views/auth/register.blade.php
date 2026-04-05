<x-guest-layout title="Join Titan Gym">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-black tracking-tighter text-main mb-2">START YOUR TRANSFORMATION</h2>
            <p class="text-text-muted text-xs font-bold uppercase tracking-widest">Become a member of the elite Titan community</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            @csrf

            <!-- Left side: Account Details -->
            <div class="glass-card p-10">
                <h3 class="text-sm font-black uppercase tracking-[0.3em] text-accent mb-10">Account Details</h3>
                
                <div class="space-y-8">
                    <!-- Name -->
                    <div class="group">
                        <x-input-label for="name" :value="__('Full Name')" class="text-[11px] font-black uppercase tracking-widest group-focus-within:text-accent transition-colors mb-2 block" />
                        <x-text-input id="name" class="premium-input" type="text" name="name" :value="old('name')" required autofocus placeholder="Enter your full name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="group">
                        <x-input-label for="email" :value="__('Email Address')" class="text-[11px] font-black uppercase tracking-widest group-focus-within:text-accent transition-colors mb-2 block" />
                        <x-text-input id="email" class="premium-input" type="email" name="email" :value="old('email')" required placeholder="your.email@example.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="group">
                        <x-input-label for="password" :value="__('Security Password')" class="text-[11px] font-black uppercase tracking-widest group-focus-within:text-accent transition-colors mb-2 block" />
                        <x-text-input id="password" class="premium-input" type="password" name="password" required placeholder="Choose a strong password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="group">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-[11px] font-black uppercase tracking-widest group-focus-within:text-accent transition-colors mb-2 block" />
                        <x-text-input id="password_confirmation" class="premium-input" type="password" name="password_confirmation" required placeholder="Re-type your password" />
                    </div>
                </div>
            </div>

            <!-- Right side: Package Selection -->
            <div class="flex flex-col">
                <div class="glass-card p-8 flex-grow">
                    <h3 class="text-sm font-black uppercase tracking-widest text-accent mb-6">Select Package</h3>
                    
                    <div class="space-y-4">
                        @foreach($packages as $package)
                            <label class="relative block cursor-pointer group">
                                <input type="radio" name="package_id" value="{{ $package->id }}" class="peer hidden" required {{ old('package_id') == $package->id ? 'checked' : '' }}>
                                <div class="glass-card p-4 border-glass-border peer-checked:border-accent peer-checked:bg-accent/5 hover:bg-glass-hover transition-all duration-300">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="text-xs font-black tracking-tight text-main">{{ strtoupper($package->name) }}</div>
                                            <div class="text-[10px] font-bold text-text-muted uppercase tracking-wider">{{ $package->duration_days }} DAYS</div>
                                        </div>
                                        <div class="text-sm font-black text-accent">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                                <div class="absolute -right-2 -top-2 w-5 h-5 bg-accent rounded-full flex items-center justify-center opacity-0 peer-checked:opacity-100 transition-opacity">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <x-input-error :messages="$errors->get('package_id')" class="mt-4" />
                </div>

                <div class="mt-8 flex items-center justify-between">
                    <a class="text-xs font-bold text-text-muted hover:text-main uppercase tracking-widest transition-colors" href="{{ route('user.login') }}">
                        Already TITAN? Login
                    </a>

                    <x-primary-button class="btn-premium px-8 py-4 text-[10px] font-black tracking-[0.2em] shadow-xl shadow-accent/20">
                        CONFIRM REGISTRATION
                    </x-primary-button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
