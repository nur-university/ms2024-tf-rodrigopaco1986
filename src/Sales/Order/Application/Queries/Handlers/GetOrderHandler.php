<?php

namespace Src\Sales\Order\Application\Queries\Handlers;

use Src\Sales\Order\Application\Queries\GetOrderQuery;
use Src\Sales\Order\Domain\Entities\Order;
use Src\Sales\Order\Domain\Repositories\OrderRepositoryInterface;

class GetOrderHandler
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function handle(GetOrderQuery $query): ?Order
    {
        $order = $this->orderRepository->findById($query->orderId);

        if ($order) {
            return $order;
        }

        return null;
    }
}
