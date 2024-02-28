<?php

namespace App\Providers;

use App\Services\Contracts\TodoServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Services\TodoService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $singletons = [
        UserServiceInterface::class => UserService::class,
        TodoServiceInterface::class => TodoService::class
    ];

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
        //
    }
}
