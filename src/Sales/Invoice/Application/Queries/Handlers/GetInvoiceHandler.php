<?php

namespace Src\Sales\Invoice\Application\Queries\Handlers;

use Src\Sales\Invoice\Application\Queries\GetInvoiceQuery;
use Src\Sales\Invoice\Domain\Entities\Invoice;
use Src\Sales\Invoice\Domain\Repositories\InvoiceRepositoryInterface;

class GetInvoiceHandler
{
    private InvoiceRepositoryInterface $invoiceRepository;

    public function __construct(InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function handle(GetInvoiceQuery $query): ?Invoice
    {
        $invoice = $this->invoiceRepository->findById($query->invoiceId);

        if ($invoice) {
            return $invoice;
        }

        return null;
    }
}
