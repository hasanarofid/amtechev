<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\GeminiService;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = BlogPost::latest()->get();
        
        $hasNewImages = false;
        $blogPath = public_path('blog-assets');
        
        if (is_dir($blogPath)) {
            $imagesInFolder = array_filter(scandir($blogPath), function($file) {
                return preg_match('/^blog\d+-\d{8}\.(png|jpg|jpeg|webp)$/i', $file);
            });
            
            $existingImages = BlogPost::where('image_url', 'like', 'blog-assets/%')->pluck('image_url')->toArray();
            
            foreach ($imagesInFolder as $img) {
                if (!in_array('blog-assets/' . $img, $existingImages)) {
                    $hasNewImages = true;
                    break;
                }
            }
        }
        
        return view('blog-posts.index', compact('posts', 'hasNewImages'));
    }

    public function generate(Request $request, GeminiService $gemini)
    {
        $blogPath = public_path('blog-assets');
        if (!is_dir($blogPath)) {
            return back()->with('error', 'Blog directory not found.');
        }

        $imagesInFolder = array_filter(scandir($blogPath), function($file) {
            return preg_match('/^blog\d+-\d{8}\.(png|jpg|jpeg|webp)$/i', $file);
        });

        $existingImages = BlogPost::where('image_url', 'like', 'blog-assets/%')->pluck('image_url')->toArray();
        $newImages = [];
        foreach ($imagesInFolder as $img) {
            if (!in_array('blog-assets/' . $img, $existingImages)) {
                $newImages[] = $img;
            }
        }

        if (empty($newImages)) {
            return back()->with('error', 'No new images found to generate content.');
        }

        $count = 0;
        foreach ($newImages as $img) {
            // Context from filename or just generic
            $context = "General EV charging and installation in Malaysia";
            
            $aiContent = $gemini->generateContent($context);
            
            if ($aiContent) {
                $parts = explode('-', explode('.', $img)[0]);
                $dateStr = end($parts) ?? date('dmY');
                
                try {
                    $publishedAt = Carbon::createFromFormat('dmY', $dateStr);
                } catch (\Exception $e) {
                    $publishedAt = now();
                }

                BlogPost::create([
                    'title' => $aiContent['title'],
                    'title_ms' => $aiContent['title_ms'],
                    'slug' => Str::slug($aiContent['title']) . '-' . rand(100, 999),
                    'excerpt' => $aiContent['excerpt'],
                    'excerpt_ms' => $aiContent['excerpt_ms'],
                    'content' => $aiContent['content'],
                    'content_ms' => $aiContent['content_ms'],
                    'image_url' => 'blog-assets/' . $img,
                    'category' => 'EV Charging',
                    'author_name' => 'Amtech AI',
                    'published_at' => $publishedAt,
                ]);
                $count++;
            }
        }

        if ($count === 0) {
            return back()->with('error', 'Failed to generate any content. Please check your Gemini API key.');
        }

        return redirect()->route('admin.blog-posts.index')->with('success', "Generated {$count} blog posts successfully.");
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
