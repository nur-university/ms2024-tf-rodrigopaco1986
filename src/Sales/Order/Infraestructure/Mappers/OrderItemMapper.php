<?php

namespace Src\Sales\Order\Infraestructure\Mappers;

use Src\Sales\Order\Domain\Entities\OrderItem as OrderItemEntity;
use Src\Sales\Order\Infraestructure\Models\OrderItem as EloquentOrderItem;

class OrderItemMapper
{
    public static function toEntity(EloquentOrderItem $orderItem): OrderItemEntity
    {
        $orderEntity = new OrderItemEntity(
            $orderItem->service_id,
            $orderItem->service_code,
            $orderItem->service_name,
            $orderItem->service_unit,
            $orderItem->quantity,
            $orderItem->price,
            $orderItem->discount,
        );

        $orderEntity->setId($orderItem->id);

        return $orderEntity;
    }

    public static function toModel(OrderItemEntity $orderItem): EloquentOrderItem
    {
        $eloquentOrderItem = (new EloquentOrderItem)
            ->fill([
                'service_id' => $orderItem->getServiceId(),
                'service_code' => $orderItem->getServiceCode(),
                'service_name' => $orderItem->getServiceName(),
                'service_unit' => $orderItem->getServiceUnit(),
                'quantity' => $orderItem->getQuantity(),
                'price' => $orderItem->getPrice(),
                'discount' => $orderItem->getDiscount(),
                'subtotal' => $orderItem->getSubTotal(),
            ]);

        return $eloquentOrderItem;
    }
}
