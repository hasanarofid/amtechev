<x-app-layout>
    <x-slot:title>Manage Hero Section</x-slot:title>
    <x-slot name="header">
        Hero Section Management
    </x-slot>

    <div class="w-full">
        <form action="{{ route('admin.site-settings.update', 0) }}" method="POST" class="space-y-8" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="glass-card p-8 space-y-6">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Hero Badge</label>
                    <input type="text" name="hero_badge" value="{{ old('hero_badge', $settings['hero_badge'] ?? '') }}" class="premium-input">
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Hero Title (HTML allowed)</label>
                    <div id="quill-editor" class="bg-glass text-main min-h-[150px] rounded-b-xl border border-glass-border"></div>
                    <input type="hidden" name="hero_title" id="quill-hidden-input" value="{{ old('hero_title', $settings['hero_title'] ?? '') }}">
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Hero Subtitle</label>
                    <textarea name="hero_subtitle" rows="3" class="premium-input">{{ old('hero_subtitle', $settings['hero_subtitle'] ?? '') }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Main CTA Text</label>
                        <input type="text" name="hero_cta_main" value="{{ old('hero_cta_main', $settings['hero_cta_main'] ?? '') }}" class="premium-input">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Secondary CTA Text</label>
                        <input type="text" name="hero_cta_secondary" value="{{ old('hero_cta_secondary', $settings['hero_cta_secondary'] ?? '') }}" class="premium-input">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Hero Background Image</label>
                    @if(isset($settings['hero_image']))
                        <div class="mb-4 aspect-video w-64 bg-white/5 rounded-lg overflow-hidden border border-glass-border">
                            <img src="{{ Str::startsWith($settings['hero_image'], 'settings/') ? asset('storage/' . $settings['hero_image']) : asset($settings['hero_image']) }}" alt="Current Background" class="w-full h-full object-cover">
                        </div>
                    @endif
                    <input type="file" name="hero_image" accept="image/*" class="premium-input px-4 py-3">
                    <p class="mt-2 text-[8px] text-text-muted italic uppercase tracking-wider">Recommended: 1920x1080px or higher.</p>
                </div>
            </div>

            <div class="flex pt-4">
                <button type="submit" class="btn-premium px-16 py-5 text-sm tracking-[0.3em]">
                    SAVE HERO SECTION
                </button>
            </div>
        </form>
    </div>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Allow Quill to preserve classes on spans
            var Inline = Quill.import('blots/inline');
            class GreenHighlight extends Inline {
                static create(value) {
                    let node = super.create();
                    node.setAttribute('class', 'text-ev-green font-outline-2');
                    return node;
                }
                static formats(node) {
                    return node.getAttribute('class');
                }
            }
            GreenHighlight.blotName = 'greenhighlight';
            GreenHighlight.tagName = 'span';
            Quill.register(GreenHighlight);

            var quill = new Quill('#quill-editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline'],
                        ['greenhighlight'], // Optional: could add a button later
                        ['link', 'clean']
                    ]
                }
            });

            // Re-register a simple span blot to avoid stripping
            let Span = Quill.import('blots/inline');
            Span.tagName = 'span';
            Quill.register(Span);

            var hiddenInput = document.getElementById('quill-hidden-input');
            
            // Critical: Don't let Quill strip unknown formats on first load
            quill.root.innerHTML = hiddenInput.value;

            quill.on('text-change', function() {
                hiddenInput.value = quill.root.innerHTML;
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
        
        /* Frontend matching styles for the editor */
        .ql-editor .text-ev-green {
            color: #00ff87; /* Matches your ev-green */
        }
        .ql-editor .font-outline-2 {
            -webkit-text-stroke: 1px #00ff87;
            text-shadow: 0 0 20px rgba(0, 255, 135, 0.2);
        }
    </style>
</x-app-layout>
