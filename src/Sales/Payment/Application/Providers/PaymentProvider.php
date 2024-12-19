<?php

namespace Src\Sales\Payment\Application\Providers;

use Illuminate\Support\ServiceProvider;

class PaymentProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void {}

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'payment');
    }
}
