<?php

namespace Src\Sales\Invoice\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Src\Sales\Invoice\Domain\Entities\InvoiceItem;

class InvoiceItemResource extends JsonResource
{
    public function __construct(InvoiceItem $invoiceItem)
    {
        $this->resource = $invoiceItem;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $invoiceItem = $this->resource;

        return [
            'id' => $invoiceItem->getId(),
            'service_code' => $invoiceItem->getServiceCode(),
            'service_name' => $invoiceItem->getServiceName(),
            'service_unit' => $invoiceItem->getServiceUnit(),
            'quantity' => $invoiceItem->getQuantity(),
            'price' => $invoiceItem->getPrice(),
            'discount' => $invoiceItem->getDiscount(),
            'subtotal' => $invoiceItem->getSubTotal(),
        ];
    }
}
