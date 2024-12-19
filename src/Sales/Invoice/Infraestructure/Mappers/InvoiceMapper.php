<?php

namespace Src\Sales\Invoice\Infraestructure\Mappers;

use Src\Sales\Invoice\Domain\Entities\Invoice as InvoiceEntity;
use Src\Sales\Invoice\Domain\ValueObject\InvoiceStatus;
use Src\Sales\Invoice\Infraestructure\Models\Invoice as EloquentInvoice;

class InvoiceMapper
{
    public static function toEntity(EloquentInvoice $invoice): InvoiceEntity
    {
        $invoiceEntity = new InvoiceEntity(
            $invoice->nit,
            $invoice->number,
            $invoice->authorization_code,
            $invoice->invoice_date,
            $invoice->customer_id,
            $invoice->customer_code,
            $invoice->customer_name,
            $invoice->customer_nit,
            new InvoiceStatus($invoice->status),
            $invoice->order_id,
        );
        $invoiceEntity->setId($invoice->id);

        $items = $invoice->items()->get();

        foreach ($items as $item) {
            $invoiceEntity->addItem(InvoiceItemMapper::toEntity($item));
        }

        return $invoiceEntity;
    }

    public static function toModel(InvoiceEntity $invoice): EloquentInvoice
    {
        $eloquentInvoiceModel = (new EloquentInvoice)
            ->fill([
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
                'order_id' => $invoice->getOrderId(),
            ]);

        return $eloquentInvoiceModel;
    }
}
