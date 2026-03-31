<x-app-layout>
    <x-slot:title>Manage Mission Section</x-slot:title>
    <x-slot name="header">
        Our Mission Section
    </x-slot>

    <div class="w-full">
        <form action="{{ route('admin.site-settings.update', 0) }}" method="POST" class="space-y-8" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="glass-card p-8 space-y-6">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Mission Title</label>
                    <input type="text" name="mission_title" value="{{ old('mission_title', $settings['mission_title'] ?? '') }}" class="premium-input">
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Mission Content</label>
                    <textarea name="mission_content" rows="4" class="premium-input">{{ old('mission_content', $settings['mission_content'] ?? '') }}</textarea>
                </div>

                <div class="pt-6 border-t border-glass-border">
                    <h4 class="text-xs font-bold text-ev-green uppercase tracking-widest mb-6">Green Call-to-Action Box</h4>
                    
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">CTA Box Content</label>
                        <div id="quill-editor" class="bg-glass text-main min-h-[150px] rounded-b-xl border border-glass-border"></div>
                        <input type="hidden" name="mission_cta_text" id="quill-hidden-input" value="{{ old('mission_cta_text', $settings['mission_cta_text'] ?? '') }}">
                    </div>
                </div>

                <div class="pt-6 border-t border-glass-border">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Mission Image (Optional Left Image)</label>
                    @if(isset($settings['mission_image']))
                        <div class="mb-4 aspect-4/5 w-64 bg-white/5 rounded-lg overflow-hidden border border-glass-border">
                            <img src="{{ Str::startsWith($settings['mission_image'], 'settings/') ? asset('storage/' . $settings['mission_image']) : asset($settings['mission_image']) }}" alt="Current Mission Image" class="w-full h-full object-cover">
                        </div>
                    @endif
                    <input type="file" name="mission_image" accept="image/*" class="premium-input px-4 py-3">
                </div>
            </div>

            <div class="flex pt-4">
                <button type="submit" class="btn-premium px-16 py-5 text-sm tracking-[0.3em]">
                    SAVE MISSION SECTION
                </button>
            </div>
        </form>
    </div>

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill('#quill-editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline'],
                        ['link', 'clean']
                    ]
                }
            });
            var oldContent = document.getElementById('quill-hidden-input').value;
            if(oldContent) {
                quill.root.innerHTML = oldContent;
            }
            quill.on('text-change', function() {
                document.getElementById('quill-hidden-input').value = quill.root.innerHTML;
            });
        });
    </script>
    <style>
        .ql-toolbar.ql-snow {
            border-color: var(--glass-border);
            border-radius: 12px 12px 0 0;
            background: var(--glass);
        }
        .ql-container.ql-snow {
            border-color: var(--glass-border);
            border-radius: 0 0 12px 12px;
        }
        .ql-editor { font-family: inherit; }
        .ql-snow .ql-stroke { stroke: var(--text-main); }
        .ql-snow .ql-fill, .ql-snow .ql-stroke.ql-fill { fill: var(--text-main); }
        .ql-snow .ql-picker { color: var(--text-main); }
    </style>
</x-app-layout>
