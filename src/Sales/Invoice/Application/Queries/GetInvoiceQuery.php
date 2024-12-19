<?php

namespace Src\Sales\Invoice\Application\Queries;

class GetInvoiceQuery
{
    public string $invoiceId;

    public function __construct(string $invoiceId)
    {
        $this->invoiceId = $invoiceId;
    }
}
