<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
 
 Route::get('/', [App\Http\Controllers\LandingPageController::class, 'index'])->name('home');
 Route::get('/catalog', function () {
     $chargers = \App\Models\Charger::all();
     $settings = \App\Models\SiteSetting::all()->pluck('value', 'key');
     return view('frontend.catalog.index', compact('chargers', 'settings'));
 })->name('catalog');

 Route::get('/installation', function () {
     $settings = \App\Models\SiteSetting::all()->pluck('value', 'key');
     return view('frontend.installation.index', compact('settings'));
 })->name('installation');

 Route::get('/blog', function () {
     $posts = \App\Models\BlogPost::latest()->get();
     $settings = \App\Models\SiteSetting::all()->pluck('value', 'key');
     return view('frontend.blog.index', compact('posts', 'settings'));
 })->name('blog');

 Route::get('/contact', function () {
     $settings = \App\Models\SiteSetting::all()->pluck('value', 'key');
     return view('frontend.contact.index', compact('settings'));
 })->name('contact');
 
 Route::middleware(['auth', 'verified'])->group(function () {
     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
     

 

 
     // Landing Page Management
     Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
         Route::resource('chargers', App\Http\Controllers\Admin\ChargerController::class);
         Route::resource('testimonials', App\Http\Controllers\Admin\TestimonialController::class);
         Route::resource('blog-posts', App\Http\Controllers\Admin\BlogPostController::class);
         Route::resource('site-settings', App\Http\Controllers\Admin\SiteSettingController::class);
     });
 
     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 });
 
 require __DIR__.'/auth.php';
