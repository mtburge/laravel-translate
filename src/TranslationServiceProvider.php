<?php

namespace itsmattburgess\LaravelTranslate;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/translate.php' => config_path('translate.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/translate.php', 'translate');

        $this->registerCommands();
        $this->registerServices();
    }

    public function registerCommands()
    {

    }

    public function registerServices()
    {
        $this->app->singleton(MethodDiscovery::class, function () {
            $config = $this->app['config']['translate'];
            return new MethodDiscovery(new Filesystem, $config['paths'], $config['methods']);
        });
    }
}
