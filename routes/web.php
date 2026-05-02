<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\ContactInquiryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Artisan;

 Route::get('/clear-cache', function() {
    Artisan::call('optimize:clear');
    return "Cache cleared!";
});


 Route::get('/', [App\Http\Controllers\LandingPageController::class, 'index'])->name('home');
 Route::get('/ref/{code}', [App\Http\Controllers\AffiliateTrackingController::class, 'track'])->name('affiliate.track');
 Route::get('/privacy-policy', function () {
    $settings = \App\Models\SiteSetting::all()->pluck('value', 'key');
    return view('frontend.privacy', compact('settings'));
 })->name('privacy');

 Route::get('/terms-of-service', function () {
    $settings = \App\Models\SiteSetting::all()->pluck('value', 'key');
    return view('frontend.terms', compact('settings'));
 })->name('terms');

Route::middleware(['auth'])->prefix('affiliate')->group(function () {
    Route::get('/join', [App\Http\Controllers\Frontend\AffiliateController::class, 'join'])->name('affiliate.join');
    Route::post('/join', [App\Http\Controllers\Frontend\AffiliateController::class, 'store'])->name('affiliate.store');
    Route::get('/dashboard', [App\Http\Controllers\Frontend\AffiliateController::class, 'index'])->name('affiliate.dashboard');
    Route::get('/history', [App\Http\Controllers\Frontend\AffiliateController::class, 'history'])->name('affiliate.history');
});
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

 Route::post('/checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'process'])->name('checkout.process');
 Route::get('/checkout/success', [App\Http\Controllers\Frontend\CheckoutController::class, 'success'])->name('checkout.success');
 Route::post('/checkout/callback', [App\Http\Controllers\Frontend\CheckoutController::class, 'callback'])->name('checkout.callback');
 Route::get('/checkout/status/{order}', [App\Http\Controllers\Frontend\CheckoutController::class, 'checkStatus'])->name('checkout.status');


 Route::get('/checkout/debug', function() {
    $rawToken = config('services.bayarcash.api_token');
    $cleanedToken = str_replace(["\r", "\n", ' '], '', $rawToken);
    
    return response()->json([
        'environment' => config('services.bayarcash.environment'),
        'raw_token_length' => strlen($rawToken),
        'cleaned_token_length' => strlen($cleanedToken),
        'token_starts_with' => substr($cleanedToken ?? '', 0, 10) . '...',
        'token_ends_with' => '...' . substr($cleanedToken ?? '', -10),
        'portal_key_length' => strlen(config('services.bayarcash.portal_key')),
        'secret_key_length' => strlen(config('services.bayarcash.secret_key')),
        'laravel_env' => app()->environment(),
        'app_url' => config('app.url'),
    ]);
});

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

  Route::get('/booking', [App\Http\Controllers\BookingController::class, 'index'])->name('booking.index');
  Route::get('/check-slot', [App\Http\Controllers\CheckSlotController::class, 'index'])->name('check-slot.index');
  Route::post('/booking', [App\Http\Controllers\BookingController::class, 'store'])->name('booking.store')->middleware('throttle:3,1');
  Route::get('/api/booking-availability', [App\Http\Controllers\BookingAvailabilityController::class, 'index'])->name('api.booking-availability');

Route::post('/contact', [App\Http\Controllers\Frontend\ContactInquiryController::class, 'store'])->name('contact.store');
 
 // User Auth Routes
 Route::get('/user/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('user.login');
 Route::get('/user/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('user.register');

 Route::middleware(['auth', 'verified', 'member'])->prefix('user')->as('user.')->group(function () {
     Route::get('/dashboard', [App\Http\Controllers\Frontend\UserDashboardController::class, 'index'])->name('dashboard');
     
     // Member Profile
     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     // Member CRUDs
     Route::get('/orders', [App\Http\Controllers\Frontend\MyOrderController::class, 'index'])->name('orders');
     Route::get('/services', [App\Http\Controllers\Frontend\MemberServiceController::class, 'index'])->name('services');
     Route::get('/settings', [App\Http\Controllers\Frontend\MemberSettingsController::class, 'index'])->name('settings');
 });

 Route::middleware(['auth'])->group(function () {
     // Global/Admin profile (fallthrough or default)
     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit_global');
     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 });

 Route::middleware(['auth', 'verified', 'admin'])->group(function () {
     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
     

 

 
     // Landing Page Management
     Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
         Route::get('/', function () {
             return redirect()->route('dashboard');
         });
         Route::resource('chargers', App\Http\Controllers\Admin\ChargerController::class);
         Route::resource('testimonials', App\Http\Controllers\Admin\TestimonialController::class);
         Route::resource('blog-posts', App\Http\Controllers\Admin\BlogPostController::class);
        Route::resource('brands', App\Http\Controllers\Admin\BrandController::class);
        Route::resource('contact-inquiries', App\Http\Controllers\Admin\ContactInquiryController::class);
        Route::post('contact-inquiries/{contact_inquiry}/reply', [App\Http\Controllers\Admin\ContactInquiryController::class, 'reply'])->name('contact-inquiries.reply');
        Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
        Route::resource('quality-brands', App\Http\Controllers\Admin\QualityBrandController::class);
        Route::resource('gallery-items', App\Http\Controllers\Admin\GalleryItemController::class);
        Route::resource('video-testimonials', App\Http\Controllers\Admin\VideoTestimonialController::class);
        
        Route::get('bookings/calendar', [App\Http\Controllers\Admin\BookingController::class, 'calendar'])->name('bookings.calendar');
        Route::post('bookings/generate-dummy', [App\Http\Controllers\Admin\BookingController::class, 'generateDummy'])->name('bookings.generate-dummy');
        Route::resource('bookings', App\Http\Controllers\Admin\BookingController::class);
        Route::resource('installation-packages', App\Http\Controllers\Admin\InstallationPackageController::class);
        
        Route::post('slots/update-global', [App\Http\Controllers\Admin\SlotController::class, 'updateGlobal'])->name('slots.update-global');
        Route::resource('slots', App\Http\Controllers\Admin\SlotController::class);
        
        Route::get('site-settings/hero', [App\Http\Controllers\Admin\SiteSettingController::class, 'hero'])->name('site-settings.hero');
        Route::get('site-settings/about', [App\Http\Controllers\Admin\SiteSettingController::class, 'about'])->name('site-settings.about');
        Route::get('site-settings/mission', [App\Http\Controllers\Admin\SiteSettingController::class, 'mission'])->name('site-settings.mission');
        Route::resource('site-settings', App\Http\Controllers\Admin\SiteSettingController::class);

        // Affiliate Management
        Route::get('affiliates', [App\Http\Controllers\Admin\AdminAffiliateController::class, 'index'])->name('affiliates.index');
        Route::get('affiliates/commissions', [App\Http\Controllers\Admin\AdminAffiliateController::class, 'commissions'])->name('affiliates.commissions');
        Route::get('affiliates/payouts', [App\Http\Controllers\Admin\AdminAffiliateController::class, 'payouts'])->name('affiliates.payouts');
        Route::post('affiliates/commissions/{commission}/approve', [App\Http\Controllers\Admin\AdminAffiliateController::class, 'approveCommission'])->name('affiliates.commissions.approve');
        Route::post('affiliates/payouts/{payout}/complete', [App\Http\Controllers\Admin\AdminAffiliateController::class, 'completePayout'])->name('affiliates.payouts.complete');
    });
 });
 
 require __DIR__.'/auth.php';
