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
        view()->share('APP_NAME', 'productospy.org');
        view()->share('data_load_map', "list");

        // Prefijo de links
        // Uso para el caso de plataforma paralela, por default dejar vacio 
        view()->share('p_link', ""); 
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
