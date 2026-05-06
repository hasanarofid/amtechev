<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\InstallationPackage;
use App\Models\Charger;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $posts = BlogPost::whereNotNull('published_at')
            ->orderBy('updated_at', 'desc')
            ->get();

        $chargers = Charger::orderBy('updated_at', 'desc')->get();

        return response()->view('frontend.sitemap', [
            'posts' => $posts,
            'chargers' => $chargers,
        ])->header('Content-Type', 'text/xml');
    }
}
