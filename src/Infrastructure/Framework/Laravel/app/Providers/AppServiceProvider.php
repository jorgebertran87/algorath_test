<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            \AlgorathTest\Application\Repository\UserRepository::class,
            \AlgorathTest\Infrastructure\Repository\Eloquent\UserRepository::class
        );

        $this->app->bind(
            \AlgorathTest\Application\Command\CommandBus::class,
            \AlgorathTest\Infrastructure\CQRS\CommandBus::class
        );

        $this->app->bind(
            \AlgorathTest\Application\Query\QueryBus::class,
            \AlgorathTest\Infrastructure\CQRS\QueryBus::class
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
