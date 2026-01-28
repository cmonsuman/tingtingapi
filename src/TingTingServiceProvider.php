<?php

namespace TingTing\Laravel;

use Illuminate\Support\ServiceProvider;

class TingTingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/tingting.php', 'tingting');

        $this->app->singleton(TingTingClient::class, function ($app) {
            return new TingTingClient($app['config']->get('tingting'));
        });

        $this->app->alias(TingTingClient::class, 'tingting');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/tingting.php' => config_path('tingting.php'),
            ], 'tingting-config');
        }
    }
}
