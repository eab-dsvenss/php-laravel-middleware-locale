<?php

namespace se\eab\php\laravel\middleware\locale\provider;

use Illuminate\Support\ServiceProvider;
use se\eab\php\laravel\middleware\locale\command\EabLocaleInstall;

class EabLocaleServiceProvider extends ServiceProvider
{

    const MIDDLEWARE_FILENAME = "EabLocaleMiddleware";

    private $basepath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;

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

        $this->publishes([
            $this->basepath . EabLocaleServiceProvider::MIDDLEWARE_FILENAME . '.php' => app_path("Http/Middleware/" . EabLocaleServiceProvider::MIDDLEWARE_FILENAME . ".php")
        ]);
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
