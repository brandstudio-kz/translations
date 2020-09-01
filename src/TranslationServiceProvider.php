<?php
namespace BrandStudio\Translations;

use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/translations.php', 'translations');

        if ($this->app->runningInConsole()) {
            $this->publish();
        }

        $this->loadRoutesFrom(__DIR__.'/routes/translations.php');

    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'brandstudio');
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'translations');

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/database/migrations');
            $this->publish();
        }
    }

    private function publish()
    {
        $this->publishes([
            __DIR__.'/config/translations.php' => config_path('translations.php')
        ], 'config');

        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__.'/resources/views/translations'      => resource_path('views/vendor/brandstudio/translations')
        ], 'views');

        $this->publishes([
            __DIR__.'/resources/lang'      => resource_path('lang/vendor/translations')
        ], 'lang');
    }

}
