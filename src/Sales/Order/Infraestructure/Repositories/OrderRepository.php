<?php

namespace Src\Sales\Order\Infraestructure\Repositories;

use Src\Sales\Order\Domain\Entities\Order;
use Src\Sales\Order\Domain\Entities\OrderItem;
use Src\Sales\Order\Domain\Repositories\OrderRepositoryInterface;
use Src\Sales\Order\Infraestructure\Mappers\OrderItemMapper;
use Src\Sales\Order\Infraestructure\Mappers\OrderMapper;
use Src\Sales\Order\Infraestructure\Models\Order as EloquentOrder;

class OrderRepository implements OrderRepositoryInterface
{
    public function findById(string $id): ?Order
    {
        $eloquentOrder = EloquentOrder::find($id);

        if ($eloquentOrder) {
            return OrderMapper::toEntity($eloquentOrder);
        }

        return null;
    }

    public function save(Order $order): ?Order
    {
        $eloquentOrderModel = OrderMapper::toModel($order);
        $eloquentOrderModel->save();

        $eloquentOrderItems = collect($order->getItems())->map(function (OrderItem $item) {
            return OrderItemMapper::toModel($item);
        })->all();

        $eloquentOrderModel->items()->saveMany($eloquentOrderItems);

        $eloquentOrderModel->load('items');

        return OrderMapper::toEntity($eloquentOrderModel);
    }
}
