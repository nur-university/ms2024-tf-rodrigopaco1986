<?php

namespace Src\Sales\Payment\Application\Listeners;

use Src\Sales\Order\Domain\Events\OrderCreatedEvent;
use Src\Sales\Order\Infraestructure\Repositories\OrderRepository;
use Src\Sales\Payment\Application\Commands\CreatePaymentScheduleCommand;
use Src\Sales\Payment\Application\Commands\Handlers\CreatePaymentScheduleCommandHandler;
use Src\Sales\Payment\Application\Services\OrderService;
use Src\Sales\Payment\Infraestructure\Repositories\PaymentScheduleRepository;

class CreateOrderPaymentSchedules
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
    public function handle(OrderCreatedEvent $orderEvent): array
    {
        $order = $orderEvent->order;
        $payload = $orderEvent->payload;
        $paymentInstallments = $payload['paymentInstallments'] ?? 1;

        $commandInvoice = new CreatePaymentScheduleCommand($order->getId(), $paymentInstallments);
        $commandInvoiceHandlerResponse = (new CreatePaymentScheduleCommandHandler(
            new PaymentScheduleRepository,
            new OrderService(new OrderRepository),
        )
        )
            ->handle($commandInvoice);

        return $commandInvoiceHandlerResponse;
    }
}
