<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = BlogPost::latest()->get();
        return view('blog-posts.index', compact('posts'));
    }

    public function create()
    {
        return view('blog-posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image_file' => 'nullable|image|max:2048',
            'category' => 'nullable|string',
            'author_name' => 'required|string',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image_file')) {
            $validated['image_url'] = $request->file('image_file')->store('blog-posts', 'public');
        }

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']) . '-' . rand(100, 999);

        BlogPost::create($validated);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post created successfully.');
    }

    public function show(BlogPost $blogPost)
    {
        return view('blog-posts.show', compact('blogPost'));
    }

    public function edit(BlogPost $blogPost)
    {
        return view('blog-posts.edit', compact('blogPost'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image_file' => 'nullable|image|max:2048',
            'category' => 'nullable|string',
            'author_name' => 'required|string',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image_file')) {
            if ($blogPost->image_url && Storage::disk('public')->exists($blogPost->image_url)) {
                Storage::disk('public')->delete($blogPost->image_url);
            }
            $validated['image_url'] = $request->file('image_file')->store('blog-posts', 'public');
        }

        $blogPost->update($validated);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();
        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post deleted successfully.');
    }
}
