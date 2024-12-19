<?php

namespace Src\Sales\Order\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Src\Sales\Order\Domain\Entities\Order;

class OrderResource extends JsonResource
{
    public function __construct(Order $order)
    {
        $this->resource = $order;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $order = $this->resource;

        return [
            'order' => [
                'id' => $order->getId(),
                'patient_id' => $order->getPatientId(),
                'order_date' => $order->getOrderDate(),
                'status' => $order->getStatus(),
                'total' => $order->getTotal(),
                'items' => new OrderItemCollection($order->getItems()),
            ],
        ];
    }
}
