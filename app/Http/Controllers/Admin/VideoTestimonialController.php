<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoTestimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoTestimonialController extends Controller
{
    public function index()
    {
        $videos = VideoTestimonial::orderBy('sort_order')->get();
        return view('video-testimonials.index', compact('videos'));
    }

    public function create()
    {
        return view('video-testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'video' => 'required|mimes:mp4,mov,ogg,qt|max:2048', // Adjusted to 2MB to match server limits
            'thumbnail' => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer',
        ]);

        $videoPath = $request->file('video')->store('videos', 'public');
        $thumbnailPath = $request->hasFile('thumbnail') 
            ? $request->file('thumbnail')->store('thumbnails', 'public') 
            : null;

        VideoTestimonial::create([
            'title' => $request->title,
            'customer_name' => $request->customer_name,
            'video_path' => $videoPath,
            'thumbnail_path' => $thumbnailPath,
            'is_published' => $request->has('is_published'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.video-testimonials.index')->with('success', 'Video testimonial added successfully.');
    }

    public function edit(VideoTestimonial $videoTestimonial)
    {
        return view('video-testimonials.edit', compact('videoTestimonial'));
    }

    public function update(Request $request, VideoTestimonial $videoTestimonial)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20480',
            'thumbnail' => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer',
        ]);

        $data = [
            'title' => $request->title,
            'customer_name' => $request->customer_name,
            'is_published' => $request->has('is_published'),
            'sort_order' => $request->sort_order ?? 0,
        ];

        if ($request->hasFile('video')) {
            Storage::disk('public')->delete($videoTestimonial->video_path);
            $data['video_path'] = $request->file('video')->store('videos', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            if ($videoTestimonial->thumbnail_path) {
                Storage::disk('public')->delete($videoTestimonial->thumbnail_path);
            }
            $data['thumbnail_path'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $videoTestimonial->update($data);

        return redirect()->route('admin.video-testimonials.index')->with('success', 'Video testimonial updated successfully.');
    }

    public function destroy(VideoTestimonial $videoTestimonial)
    {
        Storage::disk('public')->delete($videoTestimonial->video_path);
        if ($videoTestimonial->thumbnail_path) {
            Storage::disk('public')->delete($videoTestimonial->thumbnail_path);
        }
        $videoTestimonial->delete();

        return redirect()->route('admin.video-testimonials.index')->with('success', 'Video testimonial deleted successfully.');
    }
}
