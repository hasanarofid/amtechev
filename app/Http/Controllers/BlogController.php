<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::whereNotNull('published_at')->latest()->get();
        $settings = SiteSetting::all()->pluck('value', 'key');
        return view('frontend.blog.index', compact('posts', 'settings'));
    }

    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)->firstOrFail();
        $settings = SiteSetting::all()->pluck('value', 'key');
        
        // Suggest related posts
        $relatedPosts = BlogPost::where('id', '!=', $post->id)
            ->whereNotNull('published_at')
            ->take(3)
            ->get();

        return view('frontend.blog.show', compact('post', 'settings', 'relatedPosts'));
    }
}
