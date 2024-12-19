<?php

namespace Src\Sales\Order\Domain\Services;

use DateTimeImmutable;
use Src\Sales\Order\Domain\Entities\Order;
use Src\Sales\Order\Domain\Entities\OrderItem;
use Src\Sales\Order\Domain\Exceptions\ServiceNotFoundException;
use Src\Sales\Order\Domain\Exceptions\ValueException;
use Src\Sales\Order\Domain\Repositories\OrderRepositoryInterface;
use Src\Sales\Order\Domain\ValueObject\OrderStatus;

class OrderDomainService
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
    ) {
        $this->orderRepository = $orderRepository;
    }

    public function create(string $patientId, array $items, array $servicesInfo): ?Order
    {
        $order = new Order($patientId, new DateTimeImmutable, OrderStatus::CREATED());

        foreach ($items as $item) {

            $serviceItem = collect($servicesInfo)->filter(function ($value) use ($item) {
                return $item['service_id'] == $value->getId();
            })->first();

            if (! $serviceItem) {
                throw new ServiceNotFoundException($item['service_id']);
            }

            if ($item['quantity'] <= 0) {
                throw new ValueException('Quantity must be greather than 0 for service: '.$item['service_id']);
            }

            if ($item['price'] < 1) {
                throw new ValueException('Price must be greather than 0 for service: '.$item['service_id']);
            }

            if ($item['discount'] < 0) {
                throw new ValueException("Discount can't be lower than 0 for service: ".$item['service_id']);
            }

            if (($item['price'] * $item['quantity']) < $item['discount']) {
                throw new ValueException("Discount can't be lower than subtotal for service: ".$item['service_id']);
            }

            $orderItem = new OrderItem(
                $serviceItem->getId(),
                $serviceItem->getCode(),
                $serviceItem->getName(),
                $serviceItem->getUnit(),
                $item['quantity'],
                $item['price'],
                $item['discount']
            );

            $order->addItem($orderItem);
        }

        $orderEntitySaved = $this->orderRepository->save($order);

        return $orderEntitySaved;

    }
}
