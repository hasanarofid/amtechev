<x-app-layout>
    <x-slot:title>Manage Installation Packages</x-slot:title>
    <x-slot name="header">
        Installation Packages Management
    </x-slot>

    <div class="w-full space-y-6">
        <div class="flex justify-between items-center border-b border-ev-green/20 pb-4">
            <h3 class="text-xs font-black uppercase tracking-[0.3em] text-ev-green">PACKAGES LIST</h3>
            <a href="{{ route('admin.installation-packages.create') }}" class="btn-premium py-2 px-6 text-[10px] tracking-widest">
                ADD NEW PACKAGE
            </a>
        </div>

        @if(session('success'))
            <div class="p-4 glass-card border-ev-green/30 text-ev-green animate-fade-in text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 gap-6">
            @foreach($packages->groupBy('category') as $category => $items)
                <div class="space-y-4">
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-text-muted mt-8">{{ $category }}</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($items as $package)
                            <div class="glass-card p-6 flex flex-col group h-full border-l-2 {{ $package->is_active ? 'border-ev-green/50' : 'border-red-500/50' }}">
                                <div class="flex justify-between items-start mb-4">
                                    <h4 class="text-lg font-bold uppercase tracking-tight text-main">{{ $package->name }}</h4>
                                    <span class="text-xs font-black text-ev-green">RM{{ number_format($package->price, 0) }}</span>
                                </div>
                                
                                <p class="text-[10px] text-text-muted uppercase tracking-widest mb-4">
                                    {{ $package->price_unit ? 'per ' . $package->price_unit : 'one-time' }}
                                </p>

                                @if($package->features)
                                    <ul class="text-[10px] space-y-2 mb-6 text-text-muted flex-1">
                                        @foreach($package->features as $feature)
                                            <li class="flex items-center gap-2">
                                                <svg class="w-3 h-3 text-ev-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                {{ $feature }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                <div class="flex gap-4 pt-4 border-t border-glass-border mt-auto">
                                    <a href="{{ route('admin.installation-packages.edit', $package) }}" class="flex-1 text-center py-2 text-[10px] font-bold uppercase tracking-widest text-text-muted hover:text-main transition-colors">Edit</a>
                                    <form action="{{ route('admin.installation-packages.destroy', $package) }}" method="POST" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full text-center py-2 text-[10px] font-bold uppercase tracking-widest text-red-500/70 hover:text-red-500 transition-colors" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
