<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Charger;
use App\Models\Testimonial;
use App\Models\BlogPost;
use App\Models\SiteSetting;
use App\Models\Brand;
use App\Models\Service;
use App\Models\GalleryItem;
use App\Models\QualityBrand;
use App\Models\VideoTestimonial;
 
class LandingPageController extends Controller
{
    public function index()
    {
        $chargers = Charger::where('is_featured', true)->take(3)->get();
        $testimonials = Testimonial::latest()->get();
        $posts = BlogPost::whereNotNull('published_at')->latest()->take(3)->get();
        $brands = Brand::where('is_active', true)->orderBy('sort_order')->get();
        
        $settings = SiteSetting::all()->pluck('value', 'key');

        $services = Service::orderBy('sort_order')->get();
        $galleryItems = GalleryItem::orderBy('sort_order')->get();
        $qualityBrands = QualityBrand::orderBy('sort_order')->get();
        $videoTestimonials = VideoTestimonial::where('is_published', true)->orderBy('sort_order')->get();

        return view('frontend.index', compact(
            'chargers', 
            'testimonials', 
            'posts', 
            'settings', 
            'brands',
            'services',
            'galleryItems',
            'qualityBrands',
            'videoTestimonials'
        ));
    }
}
