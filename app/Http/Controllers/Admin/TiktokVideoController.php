<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TiktokVideo;
use Illuminate\Http\Request;

class TiktokVideoController extends Controller
{
    public function index()
    {
        $videos = TiktokVideo::orderBy('sort_order')->get();
        return view('admin.tiktok-videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.tiktok-videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'video_id' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $videoId = $this->extractVideoId($request->video_id);

        TiktokVideo::create([
            'title' => $request->title,
            'video_id' => $videoId,
            'is_active' => $request->has('is_active'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.tiktok-videos.index')->with('success', 'TikTok Video added successfully.');
    }

    public function edit(TiktokVideo $tiktokVideo)
    {
        return view('admin.tiktok-videos.edit', compact('tiktokVideo'));
    }

    public function update(Request $request, TiktokVideo $tiktokVideo)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'video_id' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $videoId = $this->extractVideoId($request->video_id);

        $tiktokVideo->update([
            'title' => $request->title,
            'video_id' => $videoId,
            'is_active' => $request->has('is_active'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.tiktok-videos.index')->with('success', 'TikTok Video updated successfully.');
    }

    public function destroy(TiktokVideo $tiktokVideo)
    {
        $tiktokVideo->delete();
        return redirect()->route('admin.tiktok-videos.index')->with('success', 'TikTok Video deleted successfully.');
    }

    /**
     * Helper method to extract TikTok Video ID from a URL or raw ID
     */
    private function extractVideoId($input)
    {
        // If it's a full URL like https://www.tiktok.com/@user/video/7323891000123456789
        if (preg_match('/video\/(\d+)/', $input, $matches)) {
            return $matches[1];
        }
        
        // Return raw input (assume it's already an ID) stripped of non-numeric chars
        return preg_replace('/[^0-9]/', '', $input);
    }
}
