<?php

namespace App\Providers;

use App\Services\CurrencyConverter;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('currency.converter', function(){

          return  new CurrencyConverter(config('services.currency_converter.api_key'));

        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

    }
}
