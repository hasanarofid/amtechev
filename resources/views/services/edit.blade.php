<x-app-layout>
    <x-slot:title>Edit Service</x-slot:title>
    <x-slot name="header">
        Modify Service
    </x-slot>

    <div class="max-w-2xl">
        <form action="{{ route('admin.services.update', $service) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="glass-card p-8 space-y-6">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Service Title</label>
                    <input type="text" name="title" value="{{ old('title', $service->title) }}" required class="premium-input">
                    @error('title') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Description</label>
                    <textarea name="description" rows="4" class="premium-input">{{ old('description', $service->description) }}</textarea>
                    @error('description') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <!-- Icon Selector -->
                <div x-data="{ 
                    open: false, 
                    search: '', 
                    selected: '{{ old('icon', $service->icon) }}', 
                    icons: [
                        { name: 'Lightning / Power', value: 'heroicon-o-bolt', path: 'M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z' },
                        { name: 'Residential / Home', value: 'heroicon-o-home', path: 'M2.25 12L11.204 3.045a.75.75 0 011.082 0L21.75 12m-13.5 9.157V21a.75.75 0 00.75.75h4.5a.75.75 0 00.75-.75v-6.75A.75.75 0 0012.75 13.5h-1.5a.75.75 0 00-.75.75v6.75a.75.75 0 00.75.75h-7.5a.75.75 0 01-.75-.75v-9' },
                        { name: 'Commercial / Office', value: 'heroicon-o-building-office', path: 'M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21' },
                        { name: 'Repair / Tools', value: 'heroicon-o-wrench-screwdriver', path: 'M21.75 6.375a.375.375 0 010 .75H2.25a.375.375 0 010-.75h19.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM4.5 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM19.5 12.75a.75.75 0 110-1.5.75.75 0 010 1.5z' },
                        { name: 'Safety / Shield', value: 'heroicon-o-shield-check', path: 'M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z' },
                        { name: 'Consultation / Chat', value: 'heroicon-o-chat-bubble-left-right', path: 'M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.303.024-.607.039-.913.047a3.03 3.03 0 00-1.122.316l-2.073 1.037a.75.75 0 01-1.016-.339l-.49-1.037a1.5 1.5 0 00-1.35-.859c-.312 0-.622-.01-.93-.03H9.37l-.248-1.017c-.126-.516-.508-.946-.991-1.13a9.71 9.71 0 01-2.128-1.157 1.25 1.25 0 01-.24-.13c-1.13-.933-1.442-2.34-1.1-3.535l.135-.472a11.13 11.13 0 012.355-4.148h1.22c.168 0 .332.033.485.097l1.017.42a1.5 1.5 0 001.314-.029l1.037-.518a.75.75 0 011.016.339l.49 1.037a1.5 1.5 0 001.35.859c.313 0 .62.01.926.03a11.131 11.131 0 002.353 4.148z' },
                        { name: 'Charging / Energy', value: 'heroicon-o-battery-50', path: 'M21 10.5h.375c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125H21M3.75 18h15A2.25 2.25 0 0021 15.75v-6A2.25 2.25 0 0018.75 7.5h-15A2.25 2.25 0 001.5 9.75v6A2.25 2.25 0 003.75 18z' },
                        { name: 'Pricing / Money', value: 'heroicon-o-credit-card', path: 'M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75-3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v6a2.25 2.25 0 002.25 2.25z' },
                        { name: 'Support / Time', value: 'heroicon-o-clock', path: 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z' },
                        { name: 'Verified / Quality', value: 'heroicon-o-check-badge', path: 'M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z' }
                    ],
                    get filteredIcons() {
                        return this.icons.filter(i => i.name.toLowerCase().includes(this.search.toLowerCase()))
                    }
                }" class="relative">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Service Icon</label>
                    
                    <input type="hidden" name="icon" :value="selected">
                    
                    <!-- Searchable Select Trigger -->
                    <div @click="open = !open" 
                         class="premium-input cursor-pointer flex items-center justify-between group">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex items-center justify-center text-ev-green bg-ev-green/10 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" :d="icons.find(i => i.value === selected)?.path || 'M13 2L3 14h9l-1 8 10-12h-9l1-8z'"></path>
                                </svg>
                            </div>
                            <span class="text-xs uppercase font-bold tracking-widest" x-text="icons.find(i => i.value === selected)?.name || 'Select Icon'"></span>
                        </div>
                        <svg class="w-4 h-4 text-text-muted transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                    </div>

                    <!-- Dropdown -->
                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         class="absolute z-50 w-full mt-2 glass-card p-4 shadow-2xl border border-glass-border max-h-80 overflow-y-auto custom-scrollbar">
                        
                        <input type="text" 
                               x-model="search" 
                               @click.stop 
                               placeholder="Search icons..." 
                               class="premium-input text-xs py-2 mb-4 bg-white/5 border-white/10 focus:border-ev-green/50">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <template x-for="icon in filteredIcons" :key="icon.value">
                                <div @click="selected = icon.value; open = false" 
                                     class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 cursor-pointer transition-colors border border-transparent"
                                     :class="selected === icon.value ? 'bg-ev-green/10 border-ev-green/30' : ''">
                                    <div class="w-10 h-10 flex items-center justify-center text-ev-green bg-ev-green/10 rounded-lg">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" :d="icon.path"></path>
                                        </svg>
                                    </div>
                                    <span class="text-[10px] font-bold uppercase tracking-widest" x-text="icon.name"></span>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" class="premium-input">
                    @error('sort_order') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-premium px-12 py-4 text-xs tracking-[0.2em]">
                    SAVE CHANGES
                </button>
                <a href="{{ route('admin.services.index') }}" class="btn-premium bg-glass border border-glass-border text-main hover:bg-glass/10 px-8 py-4 text-xs tracking-[0.2em] shadow-none">
                    CANCEL
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
