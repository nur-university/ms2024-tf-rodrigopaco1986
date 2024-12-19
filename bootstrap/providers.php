<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    Src\Sales\Order\Application\Providers\OrderProvider::class,
    Src\Sales\Invoice\Application\Providers\InvoiceProvider::class,
];
