<?php

namespace Razan\School;

use Illuminate\Support\ServiceProvider;

class SchoolServiceProvider extends ServiceProvider{
    public function boot(){
        
        // $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        // $this->loadViewsFrom(__DIR__.'/views','school');
        // $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->publishes([
            __DIR__.'/views' => resource_path('views'),
        ], 'school-view');
        $this->publishes([
            __DIR__.'/config/laratrust_seeder.php' => config_path('laratrust_seeder.php')
        ], 'school-config');
        $this->publishes([
            __DIR__.'/http' => app_path('http')
        ], 'school-http');
        $this->publishes([
            __DIR__.'/routes/web.php' => base_path('routes/web.php')
        ], 'school-web');
        $this->publishes([
            __DIR__.'/models' => app_path('models')
        ], 'school-models');
        $this->publishes([
            __DIR__.'/actions/fortify' => app_path('actions/fortify')
        ], 'school-fortify');
        $this->publishes([
            __DIR__.'/migrations' => database_path('migrations')
        ], 'school-migrations');
        $this->publishes([
            __DIR__.'/public' => public_path(''),
        ], 'school-public');
    }
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/laratrust_seeder.php', 'laratrust_seeder'
        );
    }

}
