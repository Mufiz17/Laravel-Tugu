<?php

namespace App\Providers;

use App\Interfaces\Repositories\AbsenRepository;
use App\Repositories\AbsenRepositoryHandler;
use App\Interfaces\Services\AbsenService;
use App\Services\AbsenServiceHandler;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            AbsenRepository::class,
            AbsenRepositoryHandler::class
        );

        $this->app->bind(
            AbsenService::class,
            AbsenServiceHandler::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
