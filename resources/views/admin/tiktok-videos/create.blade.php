<x-app-layout>
    <x-slot:title>Add TikTok Video</x-slot:title>
    <x-slot name="header">
        Add New TikTok Video
    </x-slot>

    <div class="max-w-2xl mx-auto space-y-8">
        <form action="{{ route('admin.tiktok-videos.store') }}" method="POST" class="glass-card p-8 lg:p-10">
            @csrf

            <div class="space-y-8">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Title (Optional)</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" 
                        class="w-full bg-glass border border-glass-border rounded-xl px-4 py-3 text-main focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all">
                    @error('title')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Video ID -->
                <div>
                    <label for="video_id" class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">TikTok Video ID <span class="text-red-500">*</span></label>
                    <input type="text" id="video_id" name="video_id" value="{{ old('video_id') }}" required
                        class="w-full bg-glass border border-glass-border rounded-xl px-4 py-3 text-main focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all">
                    <p class="mt-2 text-[10px] text-text-muted">Example: from https://www.tiktok.com/@thedaddyamtech/video/7323891000123456789, the ID is 7323891000123456789</p>
                    @error('video_id')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sort Order -->
                <div>
                    <label for="sort_order" class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" 
                        class="w-full bg-glass border border-glass-border rounded-xl px-4 py-3 text-main focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all">
                </div>

                <!-- Is Active -->
                <div class="flex items-center gap-3">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                        class="w-5 h-5 rounded border-glass-border bg-glass text-ev-green focus:ring-ev-green focus:ring-offset-0">
                    <label for="is_active" class="text-[10px] font-bold uppercase tracking-widest text-main">Publish / Active</label>
                </div>
            </div>

            <div class="mt-10 flex gap-4 pt-8 border-t border-glass-border">
                <a href="{{ route('admin.tiktok-videos.index') }}" class="btn-premium !bg-transparent !text-text-muted border border-glass-border hover:!text-main px-8 py-3 text-[10px] tracking-widest flex-1 text-center">
                    CANCEL
                </a>
                <button type="submit" class="btn-premium px-8 py-3 text-[10px] tracking-widest flex-1">
                    SAVE VIDEO
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
