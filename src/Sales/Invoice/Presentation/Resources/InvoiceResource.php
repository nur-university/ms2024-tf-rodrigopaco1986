<?php

namespace Src\Sales\Invoice\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Src\Sales\Invoice\Domain\Entities\Invoice;

class InvoiceResource extends JsonResource
{
    public function __construct(Invoice $invoice)
    {
        $this->resource = $invoice;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $invoice = $this->resource;

        return [
            'invoice' => [
                'id' => $invoice->getId(),
                'nit' => $invoice->getNit(),
                'number' => $invoice->getNumber(),
                'authorization_code' => $invoice->getAuthorizationCode(),
                'invoice_date' => $invoice->getInvoiceDate(),
                'customer_id' => $invoice->getCustomerId(),
                'customer_code' => $invoice->getCustomerCode(),
                'customer_name' => $invoice->getCustomerName(),
                'customer_nit' => $invoice->getCustomerNit(),
                'status' => $invoice->getStatus(),
                'total' => $invoice->getTotal(),
                'items' => new InvoiceItemCollection($invoice->getItems()),
            ],
        ];
    }
}
