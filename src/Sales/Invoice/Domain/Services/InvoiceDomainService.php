<?php

namespace Src\Sales\Invoice\Domain\Services;

use DateTimeImmutable;
use Src\Sales\Company\Domain\Entities\Company;
use Src\Sales\Invoice\Domain\Entities\Invoice;
use Src\Sales\Invoice\Domain\Entities\InvoiceItem;
use Src\Sales\Invoice\Domain\Exceptions\InvoiceAlredyCreatedException;
use Src\Sales\Invoice\Domain\Exceptions\OrderNotFoundException;
use Src\Sales\Invoice\Domain\Exceptions\PatientNotFoundException;
use Src\Sales\Invoice\Domain\Exceptions\ServiceNotFoundException;
use Src\Sales\Invoice\Domain\Repositories\InvoiceRepositoryInterface;
use Src\Sales\Invoice\Domain\ValueObject\InvoiceStatus;
use Src\Sales\Order\Domain\Entities\Order;
use Src\Sales\Patient\Domain\Entities\Patient;

class InvoiceDomainService
{
    private InvoiceRepositoryInterface $invoiceRepository;

    public function __construct(
        InvoiceRepositoryInterface $invoiceRepository,
    ) {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function create(
        ?Order $orderInfo,
        array $servicesInfo,
        ?Company $companyInfo,
        ?Patient $patientInfo,
    ): ?Invoice {

        if (! $orderInfo) {
            throw new OrderNotFoundException;
        }

        if ($this->invoiceRepository->hasActiveInvoice($orderInfo->getId())) {
            throw new InvoiceAlredyCreatedException;
        }

        if (! $patientInfo) {
            throw new PatientNotFoundException;
        }

        $invoice = new Invoice(
            $companyInfo->getNit(),
            $this->invoiceRepository->count() + 1,
            $companyInfo->getAuthorizationCode(),
            new DateTimeImmutable,
            $patientInfo->getId(),
            $patientInfo->getCode(),
            $patientInfo->getName(),
            $patientInfo->getNit(),
            InvoiceStatus::CREATED(),
            $orderInfo->getId(),
        );

        foreach ($orderInfo->getItems() as $item) {
            $serviceItem = collect($servicesInfo)->filter(function ($value) use ($item) {
                return $item->getId() == $value->getId();
            })->first();

            if (! $serviceItem) {
                throw new ServiceNotFoundException($item->getId());
            }

            $invoiceItem = new InvoiceItem(
                $serviceItem->getId(),
                $serviceItem->getCode(),
                $serviceItem->getName(),
                $serviceItem->getUnit(),
                $item->getQuantity(),
                $item->getPrice(),
                $item->getDiscount(),
            );
            $invoice->addItem($invoiceItem);
        }

        $invoiceEntitySaved = $this->invoiceRepository->save($invoice);

        return $invoiceEntitySaved;

    }
}
