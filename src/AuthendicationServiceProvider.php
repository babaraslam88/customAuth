<?php

namespace Insyghts\Authendication;

use Illuminate\Support\ServiceProvider;
use Auth_pkg\Auth;

class AuthendicationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Insyghts\Authendication\Controllers\UserController');
        // $this->app->make('Insyghts\Authendication\Services\ContactService');
        // $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class)


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes.php';
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');



    }
}
