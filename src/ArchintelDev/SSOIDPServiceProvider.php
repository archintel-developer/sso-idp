<?php
namespace ArchintelDev;

use URL;
use Illuminate\Support\ServiceProvider;

class SSOIDPServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');

        $this->publishes([
            __DIR__.'/../config/ssoidp.php' => config_path('ssoidp.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

}
