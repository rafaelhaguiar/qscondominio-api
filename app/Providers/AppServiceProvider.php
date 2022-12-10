<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(
        abstract: 'App\Repositories\IUserRepository', concrete: 'App\Repositories\UserRepositoryEloquent'
       );
    }
}
