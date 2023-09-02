<?php

namespace App\Providers;

use App\UseCases\Client\ImportClientsUseCase;
use App\UseCases\Contracts\Client\ImportClientsUseCaseInterface;
use App\UseCases\Contracts\User\UserUseCaseInterface;
use App\UseCases\User\UserUseCase;
use Illuminate\Support\ServiceProvider;

class UseCaseServiceProvider extends ServiceProvider
{
    protected $classes = [
        UserUseCaseInterface::class          => UserUseCase::class,
        ImportClientsUseCaseInterface::class => ImportClientsUseCase::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->classes as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
