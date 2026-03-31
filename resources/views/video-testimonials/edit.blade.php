<x-app-layout>
    <x-slot:title>Edit Video Feedback</x-slot:title>
    <x-slot name="header">
        Modify Video Testimonial
    </x-slot>

    <div class="max-w-4xl">
        <form action="{{ route('admin.video-testimonials.update', $videoTestimonial) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="glass-card p-10 space-y-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-4">Video Title</label>
                        <input type="text" name="title" value="{{ old('title', $videoTestimonial->title) }}" required class="premium-input text-sm">
                        @error('title') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-4">Customer Name</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name', $videoTestimonial->customer_name) }}" required class="premium-input text-sm">
                        @error('customer_name') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-4">Video File (Leave empty to keep current)</label>
                        <div class="premium-input flex flex-col items-center justify-center py-10 border-dashed border-2 hover:border-ev-green/50 transition-colors group cursor-pointer relative" onclick="document.getElementById('videoInput').click()">
                            <input type="file" name="video" id="videoInput" class="absolute inset-0 opacity-0 cursor-pointer" accept="video/*" onchange="updateFileName(this, 'videoFileName')">
                            <svg class="w-10 h-10 text-white/20 group-hover:text-ev-green/50 transition-colors mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-text-muted" id="videoFileName">Click to replace video</span>
                        </div>
                        <p class="mt-3 text-[8px] text-text-muted uppercase tracking-widest">Current: {{ basename($videoTestimonial->video_path) }}</p>
                        @error('video') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-4">Thumbnail Image</label>
                        <div class="premium-input flex flex-col items-center justify-center py-10 border-dashed border-2 hover:border-ev-green/50 transition-colors group cursor-pointer relative" onclick="document.getElementById('thumbInput').click()">
                            <input type="file" name="thumbnail" id="thumbInput" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*" onchange="updateFileName(this, 'thumbFileName')">
                            <svg class="w-10 h-10 text-white/20 group-hover:text-ev-green/50 transition-colors mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-text-muted" id="thumbFileName">Click to replace thumbnail</span>
                        </div>
                        @if($videoTestimonial->thumbnail_path)
                            <div class="mt-4 w-32 aspect-video rounded-lg overflow-hidden border border-white/10 shadow-lg">
                                <img src="{{ asset('storage/' . $videoTestimonial->thumbnail_path) }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                        @error('thumbnail') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex items-center gap-10">
                    <div class="flex-1">
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-4">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $videoTestimonial->sort_order) }}" class="premium-input text-sm">
                    </div>
                    
                    <label class="flex items-center gap-4 cursor-pointer pt-6">
                        <div class="relative">
                            <input type="checkbox" name="is_published" value="1" {{ $videoTestimonial->is_published ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-12 h-6 bg-white/10 rounded-full peer-checked:bg-ev-green/50 transition-colors border border-white/10"></div>
                            <div class="absolute left-1 top-1 w-4 h-4 bg-white/40 rounded-full transition-transform peer-checked:translate-x-6 peer-checked:bg-ev-green"></div>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-text-muted">Published</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-premium px-12 py-4 text-xs tracking-[0.2em]">
                    SAVE CHANGES
                </button>
                <a href="{{ route('admin.video-testimonials.index') }}" class="btn-premium bg-glass border border-glass-border text-main hover:bg-glass/10 px-8 py-4 text-xs tracking-[0.2em] shadow-none uppercase">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <script>
        function updateFileName(input, targetId) {
            if (input.files && input.files[0]) {
                document.getElementById(targetId).textContent = input.files[0].name;
                document.getElementById(targetId).classList.remove('text-text-muted');
                document.getElementById(targetId).classList.add('text-ev-green');
            }
        }
    </script>
</x-app-layout>
