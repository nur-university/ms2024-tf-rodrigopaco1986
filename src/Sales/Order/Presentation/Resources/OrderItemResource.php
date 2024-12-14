<?php

namespace Src\Sales\Order\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Src\Sales\Order\Domain\Entities\OrderItem;

class OrderItemResource extends JsonResource
{
    public function __construct(OrderItem $orderItem)
    {
        $this->resource = $orderItem;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $orderItem = $this->resource;

        return [
            'id' => $orderItem->getId(),
            'service_id' => $orderItem->getServiceId(),
            'service_code' => $orderItem->getServiceCode(),
            'service_name' => $orderItem->getServiceName(),
            'service_unit' => $orderItem->getServiceUnit(),
            'quantity' => $orderItem->getQuantity(),
            'price' => $orderItem->getPrice(),
            'discount' => $orderItem->getDiscount(),
            'subtotal' => $orderItem->getSubTotal(),
        ];
    }
}
