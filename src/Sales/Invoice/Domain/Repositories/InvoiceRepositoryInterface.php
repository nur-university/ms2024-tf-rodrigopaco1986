<?php

namespace Src\Sales\Invoice\Domain\Repositories;

use Src\Sales\Invoice\Domain\Entities\Invoice;

interface InvoiceRepositoryInterface
{
    public function findById(string $id): ?Invoice;

    public function save(Invoice $invoice): ?Invoice;

    public function count(): int;

    public function hasActiveInvoice(string $orderId): bool;
}
