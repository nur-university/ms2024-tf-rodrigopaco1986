<?php

namespace Src\Sales\Payment\Application\Services;

use Src\Sales\Order\Domain\Entities\Order;
use Src\Sales\Order\Domain\Repositories\OrderRepositoryInterface;

class OrderService
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getOrderInfo(string $orderId): ?Order
    {
        return $this->orderRepository->findById($orderId);
    }
}
