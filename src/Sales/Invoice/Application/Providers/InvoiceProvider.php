<?php

namespace Src\Sales\Invoice\Application\Providers;

use Illuminate\Support\ServiceProvider;

class InvoiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'invoice');
    }
}
