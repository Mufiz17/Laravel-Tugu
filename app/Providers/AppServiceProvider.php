<?php

namespace App\Providers;

use App\Services\AuthServiceHandler;
use App\Services\AbsenServiceHandler;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\Services\AuthService;
use App\Interfaces\Services\AbsenService;
use App\Repositories\AuthRepositoryHandler;
use App\Repositories\AbsenRepositoryHandler;
use App\Interfaces\Repositories\AuthRepository;
use App\Interfaces\Repositories\AbsenRepository;

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
            AuthRepository::class,
            AuthRepositoryHandler::class
        );

        $this->app->bind(
            AuthService::class,
            AuthServiceHandler::class
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
