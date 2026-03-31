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

  Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog');
  Route::get('/blog/{slug}', [App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

 Route::get('/contact', function () {
     $settings = \App\Models\SiteSetting::all()->pluck('value', 'key');
     return view('frontend.contact.index', compact('settings'));
 })->name('contact');
 
 // User Auth Routes
 Route::get('/user/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('user.login');
 Route::get('/user/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('user.register');

 Route::middleware(['auth', 'member'])->prefix('user')->as('user.')->group(function () {
     Route::get('/dashboard', [App\Http\Controllers\Frontend\UserDashboardController::class, 'index'])->name('dashboard');
 });

 Route::middleware(['auth', 'verified', 'admin'])->group(function () {
     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
     

 

 
     // Landing Page Management
     Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
         Route::resource('chargers', App\Http\Controllers\Admin\ChargerController::class);
         Route::resource('testimonials', App\Http\Controllers\Admin\TestimonialController::class);
         Route::resource('blog-posts', App\Http\Controllers\Admin\BlogPostController::class);
        Route::resource('brands', App\Http\Controllers\Admin\BrandController::class);
        Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
        Route::resource('quality-brands', App\Http\Controllers\Admin\QualityBrandController::class);
        Route::resource('gallery-items', App\Http\Controllers\Admin\GalleryItemController::class);
        Route::resource('video-testimonials', App\Http\Controllers\Admin\VideoTestimonialController::class);
        
        Route::get('site-settings/hero', [App\Http\Controllers\Admin\SiteSettingController::class, 'hero'])->name('site-settings.hero');
        Route::get('site-settings/about', [App\Http\Controllers\Admin\SiteSettingController::class, 'about'])->name('site-settings.about');
        Route::get('site-settings/mission', [App\Http\Controllers\Admin\SiteSettingController::class, 'mission'])->name('site-settings.mission');
        Route::resource('site-settings', App\Http\Controllers\Admin\SiteSettingController::class);
    });
 
     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 });
 
 require __DIR__.'/auth.php';
