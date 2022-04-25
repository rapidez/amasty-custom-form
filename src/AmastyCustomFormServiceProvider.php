<?php

namespace Rapidez\AmastyCustomForm;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Rapidez\AmastyCustomForm\View\Components\Form;

class AmastyCustomFormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'amasty-custom-form');
        Blade::component('amasty-custom-form::form', Form::class);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/amasty-custom-form'),
            ], 'views');
        }
    }
}
