<x-app-layout>
    <x-slot:title>Edit Installation Package</x-slot:title>
    <x-slot name="header">
        Edit: {{ $installationPackage->name }}
    </x-slot>

    <div class="max-w-4xl">
        <form action="{{ route('admin.installation-packages.update', $installationPackage) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="glass-card p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Category</label>
                        <select name="category" required class="premium-input bg-[#0a0a0a]">
                            <option value="Standard Package" {{ $installationPackage->category == 'Standard Package' ? 'selected' : '' }}>Standard Package</option>
                            <option value="Routing / Cabling" {{ $installationPackage->category == 'Routing / Cabling' ? 'selected' : '' }}>Routing / Cabling</option>
                            <option value="Civil / Ground Works" {{ $installationPackage->category == 'Civil / Ground Works' ? 'selected' : '' }}>Civil / Ground Works</option>
                            <option value="Electrical / Protection" {{ $installationPackage->category == 'Electrical / Protection' ? 'selected' : '' }}>Electrical / Protection</option>
                            <option value="Others" {{ $installationPackage->category == 'Others' ? 'selected' : '' }}>Others</option>
                        </select>
                        @error('category') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Package Name</label>
                        <input type="text" name="name" value="{{ old('name', $installationPackage->name) }}" required class="premium-input" placeholder="e.g. 5m Cabling & Installation">
                        @error('name') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Price (RM)</label>
                        <input type="number" name="price" value="{{ old('price', $installationPackage->price) }}" required class="premium-input" placeholder="e.g. 898">
                        @error('price') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Price Unit (Optional)</label>
                        <input type="text" name="price_unit" value="{{ old('price_unit', $installationPackage->price_unit) }}" class="premium-input" placeholder="e.g. meter, hole, run">
                        @error('price_unit') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Description (Optional)</label>
                    <textarea name="description" rows="2" class="premium-input" placeholder="Short description for admin reference...">{{ old('description', $installationPackage->description) }}</textarea>
                    @error('description') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div x-data="{ features: {{ json_encode($installationPackage->features ?? ['']) }} }">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Features / Inclusion List</label>
                    <div class="space-y-3">
                        <template x-for="(feature, index) in features" :key="index">
                            <div class="flex gap-4">
                                <input type="text" name="features[]" x-model="features[index]" class="premium-input" placeholder="e.g. Up to 5m 6mm 3-Core Cable">
                                <button type="button" @click="features.splice(index, 1)" class="text-red-500/50 hover:text-red-500 p-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        </template>
                    </div>
                    <button type="button" @click="features.push('')" class="mt-4 text-[10px] font-black uppercase tracking-widest text-ev-green hover:underline">
                        + Add Feature
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-text-muted mb-3">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $installationPackage->sort_order) }}" class="premium-input">
                    </div>
                    <div class="flex items-center gap-4 h-full pt-6">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ $installationPackage->is_active ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-ev-green"></div>
                            <span class="ml-3 text-[10px] font-bold uppercase tracking-widest text-text-muted">Active Package</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn-premium px-12 py-4 text-xs tracking-[0.2em]">
                    UPDATE PACKAGE
                </button>
                <a href="{{ route('admin.installation-packages.index') }}" class="btn-premium bg-glass border border-glass-border text-main hover:bg-glass/10 px-8 py-4 text-xs tracking-[0.2em] shadow-none">
                    CANCEL
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
