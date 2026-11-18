<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\WelcomePopup;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            try {
                if (Schema::hasTable('categories')) {
                    $navCategories = Category::with(['products' => function ($query) {
                        $query->where('status', 'active')->orderBy('id', 'asc');
                    }])->orderBy('sort_order')->get();

                    $view->with('navCategories', $navCategories);
                }

                if (Schema::hasTable('welcome_popups')) {
                    $welcomePopup = WelcomePopup::where('is_active', true)->first();
                    $view->with('welcomePopup', $welcomePopup);
                } else {
                    $view->with('welcomePopup', null);
                }
            } catch (\Throwable $e) {
                $view->with('navCategories', collect());
                $view->with('welcomePopup', null);
            }
        });
    }
}
