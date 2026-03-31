<x-app-layout>
    <x-slot:title>Manage About Section</x-slot:title>
    <x-slot name="header">
        About Section Management
    </x-slot>

    <div class="w-full">
        <form action="{{ route('admin.site-settings.update', 0) }}" method="POST" class="space-y-8" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="glass-card p-8 space-y-6">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">About Title</label>
                    <input type="text" name="about_title" value="{{ old('about_title', $settings['about_title'] ?? '') }}" class="premium-input">
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Content Paragraph 1</label>
                    <textarea name="about_content_1" rows="4" class="premium-input">{{ old('about_content_1', $settings['about_content_1'] ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Content Paragraph 2</label>
                    <textarea name="about_content_2" rows="4" class="premium-input">{{ old('about_content_2', $settings['about_content_2'] ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Green Highlight Text</label>
                    <input type="text" name="about_highlight" value="{{ old('about_highlight', $settings['about_highlight'] ?? '') }}" class="premium-input">
                </div>

                <div class="grid grid-cols-2 gap-8 pt-6 border-t border-glass-border">
                    @for($i = 1; $i <= 4; $i++)
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">About Image #{{ $i }}</label>
                            @if(isset($settings['about_image_'.$i]))
                                <div class="mb-4 aspect-square w-32 bg-white/5 rounded-lg overflow-hidden border border-glass-border">
                                    <img src="{{ Str::startsWith($settings['about_image_'.$i], 'settings/') ? asset('storage/' . $settings['about_image_'.$i]) : asset($settings['about_image_'.$i]) }}" alt="Current Image" class="w-full h-full object-cover">
                                </div>
                            @endif
                            <input type="file" name="about_image_{{ $i }}" accept="image/*" class="premium-input px-4 py-3">
                        </div>
                    @endfor
                </div>
            </div>

            <div class="flex pt-4">
                <button type="submit" class="btn-premium px-16 py-5 text-sm tracking-[0.3em]">
                    SAVE ABOUT SECTION
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
