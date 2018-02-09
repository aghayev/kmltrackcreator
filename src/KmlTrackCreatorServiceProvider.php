<?php

namespace Aghayev\KmlTrackCreator;

use Illuminate\Support\ServiceProvider;

class KmlTrackCreatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'kmltracks');
        
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/aghayev/kmltrackcreator'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes.php';
        $this->app->make('Aghayev\KmlTrackCreator\KmlTrackCreatorController');
    }
}