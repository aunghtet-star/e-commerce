<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Productcart;

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
    public function boot()
    {
        Paginator::useBootstrap();
        view()->composer('*',function($view){
            $cart_count=Productcart::where('user_id',auth()->id())->count();
            $view->with('cart_count',$cart_count);
        });
    }
}
