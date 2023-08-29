<?php

namespace App\Providers;

use App\Libraries\Responders\Contracts\JsonApiResponseInterface;
use App\Libraries\Responders\JsonApiResponse;
use App\UseCases\Contracts\User\UserUseCaseInterface;
use App\UseCases\User\UserUseCase;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $classes = [
        JsonApiResponseInterface::class => JsonApiResponse::class,
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
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
