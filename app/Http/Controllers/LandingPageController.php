<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Charger;
use App\Models\Testimonial;
use App\Models\BlogPost;
use App\Models\SiteSetting;
 
class LandingPageController extends Controller
{
    public function index()
    {
        $chargers = Charger::where('is_featured', true)->take(3)->get();
        $testimonials = Testimonial::latest()->take(3)->get();
        $posts = BlogPost::whereNotNull('published_at')->latest()->take(3)->get();
        $brands = \App\Models\Brand::where('is_active', true)->orderBy('sort_order')->get();
        
        $settings = SiteSetting::all()->pluck('value', 'key');

        return view('frontend.index', compact('chargers', 'testimonials', 'posts', 'settings', 'brands'));
    }
}
