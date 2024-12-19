<?php

namespace Src\Sales\Order\Infraestructure\Mappers;

use Src\Sales\Order\Domain\Entities\Order as OrderEntity;
use Src\Sales\Order\Domain\ValueObject\OrderStatus;
use Src\Sales\Order\Infraestructure\Models\Order as EloquentOrder;

class OrderMapper
{
    public static function toEntity(EloquentOrder $order): OrderEntity
    {
        $orderEntity = new OrderEntity(
            $order->patient_id,
            $order->order_date,
            new OrderStatus($order->status),
        );
        $orderEntity->setId($order->id);

        $items = $order->items()->get();

        foreach ($items as $item) {
            $orderEntity->addItem(OrderItemMapper::toEntity($item));
        }

        return $orderEntity;
    }

    public static function toModel(OrderEntity $order): EloquentOrder
    {
        $eloquentOrderModel = (new EloquentOrder)
            ->fill([
                'patient_id' => $order->getPatientId(),
                'order_date' => $order->getOrderDate(),
                'status' => $order->getStatus(),
                'total' => $order->getTotal(),
            ]);

        return $eloquentOrderModel;
    }
}
