<x-app-layout>
    <x-slot:title>Edit TikTok Video</x-slot:title>
    <x-slot name="header">
        Edit TikTok Video
    </x-slot>

    <div class="max-w-2xl mx-auto space-y-8">
        <form action="{{ route('admin.tiktok-videos.update', $tiktokVideo) }}" method="POST" class="glass-card p-8 lg:p-10">
            @csrf
            @method('PUT')

            <div class="space-y-8">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Title (Optional)</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $tiktokVideo->title) }}" 
                        class="w-full bg-glass border border-glass-border rounded-xl px-4 py-3 text-main focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all">
                    @error('title')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Video ID -->
                <div>
                    <label for="video_id" class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">TikTok Video ID <span class="text-red-500">*</span></label>
                    <input type="text" id="video_id" name="video_id" value="{{ old('video_id', $tiktokVideo->video_id) }}" required
                        class="w-full bg-glass border border-glass-border rounded-xl px-4 py-3 text-main focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all">
                    @error('video_id')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sort Order -->
                <div>
                    <label for="sort_order" class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $tiktokVideo->sort_order) }}" 
                        class="w-full bg-glass border border-glass-border rounded-xl px-4 py-3 text-main focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all">
                </div>

                <!-- Is Active -->
                <div class="flex items-center gap-3">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $tiktokVideo->is_active) ? 'checked' : '' }}
                        class="w-5 h-5 rounded border-glass-border bg-glass text-ev-green focus:ring-ev-green focus:ring-offset-0">
                    <label for="is_active" class="text-[10px] font-bold uppercase tracking-widest text-main">Publish / Active</label>
                </div>
            </div>

            <div class="mt-10 flex gap-4 pt-8 border-t border-glass-border">
                <a href="{{ route('admin.tiktok-videos.index') }}" class="btn-premium !bg-transparent !text-text-muted border border-glass-border hover:!text-main px-8 py-3 text-[10px] tracking-widest flex-1 text-center">
                    CANCEL
                </a>
                <button type="submit" class="btn-premium px-8 py-3 text-[10px] tracking-widest flex-1">
                    UPDATE VIDEO
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
