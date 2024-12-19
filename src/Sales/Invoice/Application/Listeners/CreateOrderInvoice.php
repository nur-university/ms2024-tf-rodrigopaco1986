<?php

namespace Src\Sales\Invoice\Application\Listeners;

use Src\Sales\Invoice\Application\Commands\CreateInvoiceCommand;
use Src\Sales\Invoice\Application\Commands\Handlers\CreateInvoiceHandler;
use Src\Sales\Invoice\Application\Services\OrderService;
use Src\Sales\Invoice\Application\Services\PatientService;
use Src\Sales\Invoice\Application\Services\ServiceService;
use Src\Sales\Invoice\Domain\Entities\Invoice;
use Src\Sales\Invoice\Infraestructure\Repositories\InvoiceRepository;
use Src\Sales\Order\Domain\Events\OrderCreatedEvent;
use Src\Sales\Order\Infraestructure\Repositories\OrderRepository;
use Src\Sales\Patient\Infraestructure\Repositories\PatientRepository;
use Src\Sales\Service\Infraestructure\Repositories\ServiceRepository;

class CreateOrderInvoice
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreatedEvent $orderEvent): ?Invoice
    {
        $order = $orderEvent->order;
        $payload = $orderEvent->payload;
        $generateInvoice = $payload['generateInvoice'] ?? 0;

        if ($generateInvoice) {
            $commandInvoice = new CreateInvoiceCommand($order->getId(), $order->getPatientId());
            $commandInvoiceHandlerResponse = (new CreateInvoiceHandler(
                new InvoiceRepository,
                new OrderService(new OrderRepository),
                new PatientService(new PatientRepository),
                new ServiceService(new ServiceRepository),
            )
            )
                ->handle($commandInvoice);

            return $commandInvoiceHandlerResponse;
        }

        return null;
    }
}
