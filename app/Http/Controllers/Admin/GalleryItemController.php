<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryItemController extends Controller
{
    public function index()
    {
        $items = GalleryItem::orderBy('sort_order')->get();
        return view('gallery-items.index', compact('items'));
    }

    public function create()
    {
        return view('gallery-items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'image_file' => 'required|image|max:2048',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image_file')) {
            $validated['image_path'] = $request->file('image_file')->store('gallery', 'public');
        }

        GalleryItem::create($validated);

        return redirect()->route('admin.gallery-items.index')->with('success', 'Gallery item added successfully.');
    }

    public function edit(GalleryItem $galleryItem)
    {
        return view('gallery-items.edit', compact('galleryItem'));
    }

    public function update(Request $request, GalleryItem $galleryItem)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image_file')) {
            if ($galleryItem->image_path && Storage::disk('public')->exists($galleryItem->image_path)) {
                Storage::disk('public')->delete($galleryItem->image_path);
            }
            $validated['image_path'] = $request->file('image_file')->store('gallery', 'public');
        }

        $galleryItem->update($validated);

        return redirect()->route('admin.gallery-items.index')->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(GalleryItem $galleryItem)
    {
        if ($galleryItem->image_path && Storage::disk('public')->exists($galleryItem->image_path)) {
            Storage::disk('public')->delete($galleryItem->image_path);
        }
        $galleryItem->delete();
        return redirect()->route('admin.gallery-items.index')->with('success', 'Gallery item deleted successfully.');
    }
}
