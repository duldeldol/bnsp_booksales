<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (!app()->runningInConsole()) {
            \Illuminate\Support\Facades\View::composer('*', function ($view) {
                if (\Illuminate\Support\Facades\Auth::check()) {
                    $cartCount = \App\Models\Cart::where('user_id', \Illuminate\Support\Facades\Auth::id())->sum('quantity');
                    $view->with('cartCount', (int)$cartCount);
                } else {
                    $view->with('cartCount', 0);
                }
            });
        }
    }
}
