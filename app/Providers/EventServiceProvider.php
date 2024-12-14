<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Src\Sales\Invoice\Domain\Listeners\CreateOrderInvoice;
use Src\Sales\Order\Domain\Events\OrderCreatedEvent;
use Src\Sales\Payment\Domain\Listeners\CreateOrderPaymentSchedules;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        OrderCreatedEvent::class => [
            CreateOrderPaymentSchedules::class,
            CreateOrderInvoice::class,
        ],
        //InvoiceCreatedEvent::class => [
        //    SendEmailInvoice::class,
        //],
        //PaymentRegisteredEvent::class => [
        //    NotifyPaymentRegistered::class,
        //],
    ];

    public function boot()
    {
        parent::boot();
    }
}
