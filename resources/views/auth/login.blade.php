<x-guest-layout>
    <x-slot:title>Secure Login</x-slot:title>
    <div class="mb-4">
        <h2 class="text-xl font-bold text-main">Welcome Back</h2>
        <p class="text-xs text-text-muted uppercase tracking-widest mt-1">Please enter your credentials to continue</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-2">Email Address</label>
            <input id="email" class="premium-input @error('email') border-red-500 @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="admin@amtechev.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-[10px] uppercase font-bold text-red-400" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-2">
                <label for="password" class="block text-[10px] font-bold uppercase tracking-widest text-text-muted">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-[10px] uppercase font-bold text-accent hover:underline" href="{{ route('password.request') }}">
                        Forgot?
                    </a>
                @endif
            </div>
            <input id="password" class="premium-input @error('password') border-red-500 @enderror"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />

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
