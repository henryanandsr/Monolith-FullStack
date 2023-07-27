<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Repositories\Interfaces\OrdersRepositoryInterface',
            'App\Repositories\Eloquent\OrdersRepository',
        );
        $this->app->bind(
            'App\Repositories\Interfaces\BarangRepositoryInterface',
            'App\Repositories\Eloquent\BarangRepository',
        );
        $this->app->bind(
            'App\Repositories\Interfaces\PenggunaRepositoryInterface',
            'App\Repositories\Eloquent\PenggunaRepository',
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
