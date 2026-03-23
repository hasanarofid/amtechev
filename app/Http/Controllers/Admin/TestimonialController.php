<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'author_name' => 'required|string|max:255',
            'author_role' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|max:2048',
            'rating' => 'integer|min:1|max:5',
        ]);

        if ($request->hasFile('image_file')) {
            $validated['author_image'] = $request->file('image_file')->store('testimonials', 'public');
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    public function show(Testimonial $testimonial)
    {
        return view('testimonials.show', compact('testimonial'));
    }

    public function edit(Testimonial $testimonial)
    {
        return view('testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'author_name' => 'required|string|max:255',
            'author_role' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|max:2048',
            'rating' => 'integer|min:1|max:5',
        ]);

        if ($request->hasFile('image_file')) {
            if ($testimonial->author_image && Storage::disk('public')->exists($testimonial->author_image)) {
                Storage::disk('public')->delete($testimonial->author_image);
            }
            $validated['author_image'] = $request->file('image_file')->store('testimonials', 'public');
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
