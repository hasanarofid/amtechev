<x-app-layout>
    <x-slot:title>Manage Testimonials</x-slot:title>
    <x-slot name="header">
        Testimonials
    </x-slot>

    <div class="flex justify-between items-center mb-8">
        <p class="text-text-muted text-sm font-medium">Manage customer reviews and expert feedback displayed on the landing page.</p>
        <a href="{{ route('admin.testimonials.create') }}" class="btn-premium">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Add Testimonial
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 glass-card border-ev-green/30 text-ev-green animate-fade-in text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($testimonials as $testimonial)
            <div class="glass-card p-8 flex flex-col justify-between group">
                <div>
                    <div class="flex gap-1 mb-6">
                        @for($i=0; $i<$testimonial->rating; $i++)
                            <svg class="w-4 h-4 text-ev-green fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @endfor
                    </div>
                    <p class="text-text-muted italic text-sm leading-relaxed mb-8">"{{ $testimonial->content }}"</p>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-ev-green/20 rounded-full overflow-hidden border border-ev-green/20">
                            @if($testimonial->author_image)
                                <img src="{{ $testimonial->author_image }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-ev-green font-bold text-xs uppercase">{{ substr($testimonial->author_name, 0, 1) }}</div>
                            @endif
                        </div>
                        <div>
                            <p class="font-bold text-xs text-main uppercase tracking-wider">{{ $testimonial->author_name }}</p>
                            <p class="text-[10px] text-text-muted uppercase tracking-widest">{{ $testimonial->author_role }}</p>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="p-2 text-text-muted hover:text-ev-green transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </a>
                        <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-text-muted hover:text-red-500 transition-colors" onclick="return confirm('Are you sure?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 glass-card flex flex-col items-center justify-center text-text-muted">
                <svg class="mb-4 opacity-20" xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                <p class="text-lg">No testimonials available yet.</p>
                <a href="{{ route('admin.testimonials.create') }}" class="mt-4 text-ev-green font-bold hover:underline">Create your first testimonial</a>
            </div>
        @endforelse
    </div>
</x-app-layout>
