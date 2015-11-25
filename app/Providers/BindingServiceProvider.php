<?php

namespace Dixit\Providers;

use Illuminate\Support\ServiceProvider;

class BindingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;
        $app->bind('Dixit\InterfaceDAO\PlayerInterface', 
                'Dixit\ImplementationEloquentDAO\PlayerRepository');
        $app->bind('Dixit\InterfaceDAO\GameInterface', 'Dixit\ImplementationEloquentDAO\GameRepository');
    }
}
