<x-app-layout>
    <x-slot:title>Manage Services Section</x-slot:title>
    <x-slot name="header">
        Services & Expertise Management
    </x-slot>

    <div class="w-full space-y-12">
        <!-- Expertise Section Settings -->
        <form action="{{ route('admin.site-settings.update', 0) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <h3 class="text-xs font-black uppercase tracking-[0.3em] text-ev-green border-b border-ev-green/20 pb-4">EXPERTISE SECTION CONTENT</h3>
            
            <div class="glass-card p-8 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Section Badge</label>
                        <input type="text" name="services_badge" value="{{ old('services_badge', $settings['services_badge'] ?? '') }}" class="premium-input">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Section Title</label>
                        <input type="text" name="services_title" value="{{ old('services_title', $settings['services_title'] ?? '') }}" class="premium-input">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Section Description</label>
                    <textarea name="services_content" rows="3" class="premium-input">{{ old('services_content', $settings['services_content'] ?? '') }}</textarea>
                </div>

                <div class="pt-6 border-t border-glass-border">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Expertise Main Image (Left Image)</label>
                    @if(isset($settings['services_image']))
                        <div class="mb-4 aspect-square w-64 bg-white/5 rounded-2xl overflow-hidden border border-glass-border">
                            <img src="{{ Str::startsWith($settings['services_image'], 'settings/') ? asset('storage/' . $settings['services_image']) : asset($settings['services_image']) }}" alt="Current Expertise Image" class="w-full h-full object-cover">
                        </div>
                    @endif
                    <input type="file" name="services_image" accept="image/*" class="premium-input px-4 py-3">
                </div>

                <div class="flex">
                    <button type="submit" class="btn-premium px-12 py-4 text-xs tracking-widest">
                        UPDATE SECTION CONTENT
                    </button>
                </div>
            </div>
        </form>

        <!-- Individual Services Management -->
        <div class="space-y-6">
            <div class="flex justify-between items-center border-b border-ev-green/20 pb-4">
                <h3 class="text-xs font-black uppercase tracking-[0.3em] text-ev-green">INDIVIDUAL SERVICES LIST</h3>
                <a href="{{ route('admin.services.create') }}" class="btn-premium py-2 px-6 text-[10px] tracking-widest">
                    ADD NEW SERVICE
                </a>
            </div>

            @if(session('success'))
                <div class="p-4 glass-card border-ev-green/30 text-ev-green animate-fade-in text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($services as $service)
                    <div class="glass-card p-8 flex flex-col group h-full">
                        <div class="mb-6 text-ev-green">
                            @if($service->icon)
                                @if(Str::startsWith($service->icon, 'heroicon'))
                                    @svg($service->icon, 'w-8 h-8')
                                @else
                                    {!! $service->icon !!}
                                @endif
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path></svg>
                            @endif
                        </div>
                        
                        <h4 class="text-xl font-bold uppercase tracking-tight text-main mb-4">{{ $service->title }}</h4>
                        <p class="text-text-muted text-xs leading-relaxed mb-8 flex-1">{{ $service->description }}</p>
                        
                        <div class="flex gap-4 pt-6 border-t border-glass-border">
                            <a href="{{ route('admin.services.edit', $service) }}" class="flex-1 text-center py-2 text-[10px] font-bold uppercase tracking-widest text-text-muted hover:text-main transition-colors">Edit</a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-center py-2 text-[10px] font-bold uppercase tracking-widest text-red-500/70 hover:text-red-500 transition-colors" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 glass-card flex flex-col items-center justify-center text-text-muted">
                        <p class="text-lg">No services managed yet.</p>
                        <a href="{{ route('admin.services.create') }}" class="mt-4 text-ev-green font-bold hover:underline">Add your first service</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
