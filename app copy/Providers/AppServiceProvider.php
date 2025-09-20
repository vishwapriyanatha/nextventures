<?php

namespace App\Providers;

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
        $this->app->bind('App\Contracts\Repositories\OrderRepositoryInterface', 'App\Repositories\OrderRepository');
        $this->app->bind('App\Contracts\Repositories\ItemRepositoryInterface', 'App\Repositories\ItemRepository');
        $this->app->bind('App\Contracts\Repositories\StockRepositoryInterface', 'App\Repositories\StockRepository');

        $this->app->bind('App\Contracts\Services\OrderServiceInterface', 'App\Services\OrderService');
        $this->app->bind('App\Contracts\Services\KpiServiceInterface', 'App\Services\KpiService');
    }
}
