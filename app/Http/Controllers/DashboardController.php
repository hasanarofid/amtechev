<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_customers' => User::where('role', 'member')->count(),
            'total_chargers' => \App\Models\Charger::count(),
            'total_testimonials' => \App\Models\Testimonial::count(),
            'total_blog_posts' => \App\Models\BlogPost::count(),
        ];

        return view('dashboard', compact('stats'));
    }
}
