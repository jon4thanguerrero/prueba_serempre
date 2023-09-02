<?php

namespace App\Providers;

use App\Repositories\City\CityRepository;
use App\Repositories\Client\ClientRepository;
use App\Repositories\Contracts\City\CityRepositoryInterface;
use App\Repositories\Contracts\Client\ClientRepositoryInterface;
use App\Repositories\Contracts\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $classes = [
        UserRepositoryInterface::class => UserRepository::class,
        CityRepositoryInterface::class => CityRepository::class,
        ClientRepositoryInterface::class => ClientRepository::class,
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
