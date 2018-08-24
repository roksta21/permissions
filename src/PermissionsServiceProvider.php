<?php

namespace Roksta\Permit;

use Illuminate\Support\ServiceProvider;
use Roksta\Permit\Commands\PermissionsCommands;

class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
        * Copy files
        */
        $this->publishes([
            // Config File
            __DIR__.'/../config/permitions.php' => config_path('permitions.php'),
            // Views
            __DIR__.'/../views' => resource_path('views/vendor/roksta')
        ]);

        /*
        * Import routes
        */
        $this->loadRoutesFrom(__DIR__.'/../routes/routes.php');

        /*
        * Run migrations
        */
        $this->loadMigrationsFrom(__DIR__.'/../migrations');

        /*
        * Register console commands
        */
        if ($this->app->runningInConsole()) {
            $this->commands([
                PermissionsCommands::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind();
        
    }
}