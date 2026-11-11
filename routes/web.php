<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Public Website Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/turnkey-solutions', [HomeController::class, 'solutions'])->name('solutions.index');
Route::get('/turnkey-solutions/{slug}', [HomeController::class, 'solutionDetail'])->name('solutions.show');

Route::get('/about-dixion', [HomeController::class, 'about'])->name('about');
Route::get('/news-events', [HomeController::class, 'news'])->name('news');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/request-quote', [HomeController::class, 'quote'])->name('quote');

// Form Submissions
Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');

// Admin Management
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/inquiries', [AdminController::class, 'inquiries'])->name('inquiries');
    Route::post('/inquiries/{id}/status', [AdminController::class, 'updateStatus'])->name('inquiries.status');
});
