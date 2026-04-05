<x-app-layout>
    <x-slot:title>Specialized Services</x-slot:title>

    <div class="p-8">
    <div class="mb-12 text-center md:text-left">
        <h2 class="text-3xl font-black tracking-tight text-main uppercase italic">Specialized Services</h2>
        <p class="text-[10px] font-black text-text-muted mt-2 uppercase tracking-[0.3em]">Premium EV Installation & Maintenance Solutions</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($services as $service)
            <div class="glass-card group p-1 w-full rounded-[32px] hover:scale-[1.02] transition-all duration-500 overflow-hidden relative shadow-2xl">
                <div class="p-8 h-full flex flex-col">
                    <div class="h-16 w-16 bg-accent/5 rounded-2xl flex items-center justify-center text-accent mb-6 shadow-inner group-hover:bg-accent/10 transition-colors">
                        @if($service->service_icon)
                            <img src="{{ asset('storage/' . $service->service_icon) }}" alt="Icon" class="w-8 h-8 object-contain">
                        @else
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        @endif
                    </div>
                    <h3 class="text-xl font-black text-main uppercase tracking-tight mb-4">{{ $service->name }}</h3>
                    <p class="text-text-muted text-sm leading-relaxed mb-8 flex-grow">{{ $service->description }}</p>
                    <div class="pt-6 border-t border-glass-border flex items-center justify-between">
                        <span class="text-[10px] font-black text-accent uppercase tracking-widest">{{ $service->category ?? 'Specialist' }}</span>
                        <a href="#" class="h-10 w-10 bg-accent text-black rounded-xl flex items-center justify-center hover:scale-110 transition-transform shadow-lg shadow-accent/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</x-app-layout>
