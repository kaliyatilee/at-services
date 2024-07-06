<?php

namespace Modules\Messaging\Providers;

use Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class MessagingServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    public function provides(): array
    {
        return [];
    }

    private function registerConfig(): void
    {
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('messaging.php')
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'messaging'
        );
    }

    private function registerFactories(): void
    {
        if (! $this->app->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(__DIR__ . '/../database/factories');
        }
    }

    private function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/messaging');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'messaging');
        } else {
            $this->loadTranslationsFrom(__DIR__  .'/../resources/lang', 'messaging');
        }
    }

    private function registerViews(): void
    {
        $viewPath = resource_path('views/modules/messaging');

        $sourcePath = __DIR__ . '/../resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(static function ($path) {
            return "{$path}/modules/messaging";
        }, Config::get('view.paths')), [$sourcePath]), 'messaging');
    }
}
