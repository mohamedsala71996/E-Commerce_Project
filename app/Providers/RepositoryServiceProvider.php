<?php

namespace App\Providers;

use App\data\Abilities;
use App\Interfaces\CartRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\DataRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Repositories\CartRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\DataRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(DataRepositoryInterface::class, DataRepository::class);
       
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
