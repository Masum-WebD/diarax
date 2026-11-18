<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Route;

// Public Website Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/compare', [ProductController::class, 'compare'])->name('products.compare');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{slug}/datasheet', [ProductController::class, 'datasheet'])->name('products.datasheet');

Route::get('/turnkey-solutions', [HomeController::class, 'solutions'])->name('solutions.index');
Route::get('/turnkey-solutions/{slug}', [HomeController::class, 'solutionDetail'])->name('solutions.show');

Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/about-us', [HomeController::class, 'about'])->name('about.us');
Route::get('/about-dixion', [HomeController::class, 'about'])->name('about.legacy');
Route::get('/service-support', [HomeController::class, 'serviceSupport'])->name('service.support');
Route::get('/downloads', [HomeController::class, 'downloads'])->name('downloads');
Route::get('/news-events', [HomeController::class, 'news'])->name('news');
Route::get('/news-gallery', [HomeController::class, 'news'])->name('news.gallery');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('contact.us');
Route::get('/request-quote', [HomeController::class, 'quote'])->name('quote');

// Form Submissions
Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');

// Admin Authentication
Route::get('/login', fn () => redirect()->route('admin.login'))->name('login');
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Protected Admin Portal
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [AdminController::class, 'index']);

    // 1. Banners Module
    Route::get('/banners', [AdminController::class, 'banners'])->name('banners.index');
    Route::post('/banners', [AdminController::class, 'storeBanner'])->name('banners.store');
    Route::put('/banners/{id}', [AdminController::class, 'updateBanner'])->name('banners.update');
    Route::delete('/banners/{id}', [AdminController::class, 'destroyBanner'])->name('banners.destroy');

    // 2. Categories Module
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories.index');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{id}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');

    // 3. Products Module
    Route::get('/products', [AdminController::class, 'products'])->name('products.index');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
    Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{id}', [AdminController::class, 'destroyProduct'])->name('products.destroy');

    // 4. Welcome Popup Module
    Route::get('/popup', [AdminController::class, 'popup'])->name('popup.index');
    Route::post('/popup', [AdminController::class, 'updatePopup'])->name('popup.update');

    // 5. Purchases Module
    Route::get('/purchases', [AdminController::class, 'purchases'])->name('purchases.index');
    Route::post('/purchases', [AdminController::class, 'storePurchase'])->name('purchases.store');

    // 6. Sales Module
    Route::get('/sales', [AdminController::class, 'sales'])->name('sales.index');
    Route::post('/sales', [AdminController::class, 'storeSale'])->name('sales.store');

    // Inquiries & Quotes
    Route::get('/inquiries', [AdminController::class, 'inquiries'])->name('inquiries');
    Route::post('/inquiries/{id}/status', [AdminController::class, 'updateStatus'])->name('inquiries.status');
});
