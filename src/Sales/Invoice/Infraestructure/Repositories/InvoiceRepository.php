<?php

namespace Src\Sales\Invoice\Infraestructure\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Src\Sales\Invoice\Domain\Entities\Invoice;
use Src\Sales\Invoice\Domain\Entities\InvoiceItem;
use Src\Sales\Invoice\Domain\Repositories\InvoiceRepositoryInterface;
use Src\Sales\Invoice\Domain\ValueObject\InvoiceStatus;
use Src\Sales\Invoice\Infraestructure\Mappers\InvoiceItemMapper;
use Src\Sales\Invoice\Infraestructure\Mappers\InvoiceMapper;
use Src\Sales\Invoice\Infraestructure\Models\Invoice as EloquentInvoice;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function findById(string $id): ?Invoice
    {
        $eloquentInvoice = EloquentInvoice::find($id);

        if ($eloquentInvoice) {
            return InvoiceMapper::toEntity($eloquentInvoice);
        }

        return null;
    }

    public function save(Invoice $invoice): ?Invoice
    {
        try {
            return DB::transaction(function () use ($invoice) {
                $eloquentInvoiceModel = InvoiceMapper::toModel($invoice);
                $eloquentInvoiceModel->save();

                $eloquentInvoiceItems = collect($invoice->getItems())->map(function (InvoiceItem $item) {
                    return InvoiceItemMapper::toModel($item);
                })->all();

                $eloquentInvoiceModel->items()->saveMany($eloquentInvoiceItems);

                $eloquentInvoiceModel->load('items');

                return InvoiceMapper::toEntity($eloquentInvoiceModel);
            });
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return null;
    }

    public function count(): int
    {
        return EloquentInvoice::count();
    }

    public function hasActiveInvoice(string $orderId): bool
    {
        return EloquentInvoice::where('order_id', $orderId)
            ->where('status', InvoiceStatus::CREATED()->getStatus())
            ->count() > 0;
    }
}
