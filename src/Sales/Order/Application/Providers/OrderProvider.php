<?php

namespace Src\Sales\Order\Application\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Src\Sales\Order\Domain\Events\DemoEvent;
use Src\Sales\Order\Domain\Listeners\DemoListener;

class OrderProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //$this->mergeConfigFrom(__DIR__.'/../config/claim_submission.php', 'domain-driven-laravel');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'order');

        //Event::listen(DemoEvent::class, DemoListener::class);
        //$this->loadMigrationsFrom(__DIR__ . '/../../Infrastructure/Database/migrations');
        //$this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'domain-driven-laravel');
        //$this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');
    }
}
