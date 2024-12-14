<?php

namespace Src\Sales\Order\Application\Commands\Handlers;

use Src\Sales\Order\Application\Commands\CreateOrderCommand;
use Src\Sales\Order\Application\Services\ServiceService;
use Src\Sales\Order\Domain\Entities\Order;
use Src\Sales\Order\Domain\Events\OrderCreatedEvent;
use Src\Sales\Order\Domain\Repositories\OrderRepositoryInterface;
use Src\Sales\Order\Domain\Services\OrderDomainService;

final class CreateOrderHandler
{
    private OrderRepositoryInterface $orderRepository;

    private ServiceService $serviceService;

    public function __construct(OrderRepositoryInterface $orderRepository, ServiceService $serviceService)
    {
        $this->orderRepository = $orderRepository;
        $this->serviceService = $serviceService;
    }

    public function handle(CreateOrderCommand $command): ?Order
    {
        $serviceIds = collect($command->getItems())->pluck('service_id')->toArray();
        $servicesInfo = $this->serviceService->getServicesInfo($serviceIds);
        $orderEntitySaved = (new OrderDomainService($this->orderRepository))->create($command->getPatientId(), $command->getItems(), $servicesInfo);

        if ($orderEntitySaved) {
            OrderCreatedEvent::dispatch($orderEntitySaved, [
                'paymentInstallments' => $command->getPaymentInstallments(),
                'generateInvoice' => $command->getGenerateInvoice(),
            ]);
        }

        return $orderEntitySaved;
    }
}
