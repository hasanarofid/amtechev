<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
 
 Route::get('/', [App\Http\Controllers\LandingPageController::class, 'index'])->name('home');
 Route::get('/catalog', [App\Http\Controllers\CatalogController::class, 'index'])->name('catalog');
 Route::get('/catalog/{id}', [App\Http\Controllers\CatalogController::class, 'show'])->name('catalog.show');
 Route::post('/cart/add/{charger}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
 Route::patch('/cart/update/{id}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
 Route::delete('/cart/remove/{id}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

 Route::get('/checkout', function () {
     $settings = \App\Models\SiteSetting::all()->pluck('value', 'key');
     $cart = session('cart', []);
     return view('frontend.checkout', compact('settings', 'cart'));
 })->name('checkout');

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
