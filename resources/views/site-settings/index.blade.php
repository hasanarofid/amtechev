<x-app-layout>
    <x-slot:title>Site Settings</x-slot:title>
    <x-slot name="header">
        Landing Page Settings
    </x-slot>

    <div class="w-full">
        <form action="{{ route('admin.site-settings.update', 0) }}" method="POST" class="space-y-12">
            @csrf
            @method('PUT')

            @foreach($settings as $group => $groupSettings)
                <div class="space-y-6">
                    <h3 class="text-xs font-black uppercase tracking-[0.3em] text-ev-green border-b border-ev-green/20 pb-4">{{ strtoupper($group) }} SECTION</h3>
                    
                    <div class="glass-card p-8 space-y-8">
                        @foreach($groupSettings as $setting)
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">{{ str_replace('_', ' ', $setting->key) }}</label>
                                @if(Str::contains($setting->key, ['content', 'subtitle', 'title', 'about', 'address']))
                                    <textarea name="{{ $setting->key }}" class="premium-input min-h-[100px]">{{ $setting->value }}</textarea>
                                @else
                                    <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="premium-input">
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="flex pt-4">
                <button type="submit" class="btn-premium px-16 py-5 text-sm tracking-[0.3em]">
                    SAVE ALL SETTINGS
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
