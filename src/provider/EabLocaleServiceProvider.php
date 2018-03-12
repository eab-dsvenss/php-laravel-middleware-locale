<?php

namespace se\eab\php\laravel\middleware\locale\provider;

use Illuminate\Support\ServiceProvider;
use se\eab\php\laravel\middleware\locale\command\EabLocaleInstall;

class EabLocaleServiceProvider extends ServiceProvider
{

    const MIDDLEWARE_FILENAME = "EabLocaleMiddleware";

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        if ($this->app->runningInConsole()) {
            $this->commands([
                EabLocaleInstall::class,
            ]);
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
