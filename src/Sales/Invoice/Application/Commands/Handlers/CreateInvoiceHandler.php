<?php

namespace Src\Sales\Invoice\Application\Commands\Handlers;

use Src\Sales\Invoice\Application\Commands\CreateInvoiceCommand;
use Src\Sales\Invoice\Application\Services\CompanyService;
use Src\Sales\Invoice\Application\Services\OrderService;
use Src\Sales\Invoice\Application\Services\PatientService;
use Src\Sales\Invoice\Application\Services\ServiceService;
use Src\Sales\Invoice\Domain\Entities\Invoice;
use Src\Sales\Invoice\Domain\Repositories\InvoiceRepositoryInterface;
use Src\Sales\Invoice\Domain\Services\InvoiceDomainService;
use Src\Sales\Order\Domain\Entities\OrderItem;

final class CreateInvoiceHandler
{
    private InvoiceRepositoryInterface $invoiceRepository;

    private OrderService $orderService;

    private PatientService $patientService;

    private ServiceService $serviceService;

    public function __construct(
        InvoiceRepositoryInterface $invoiceRepository,
        OrderService $orderService,
        PatientService $patientService,
        ServiceService $serviceService
    ) {
        $this->invoiceRepository = $invoiceRepository;
        $this->orderService = $orderService;
        $this->patientService = $patientService;
        $this->serviceService = $serviceService;
    }

    public function handle(CreateInvoiceCommand $command): ?Invoice
    {
        $orderInfo = $this->orderService->getOrderInfo($command->getOrderId());
        $customerId = $command->getCustomerId() ? $command->getCustomerId() : $orderInfo->getPatientId();
        $patientInfo = $this->patientService->getPatientInfo($customerId);
        $companyInfo = (new CompanyService)->getInfo();

        $items = $orderInfo?->getItems() ?? [];
        $serviceIds = collect($items)->map(function (OrderItem $value) {
            return $value->getId();
        })->toArray();
        $servicesInfo = $this->serviceService->getServicesInfo($serviceIds);

        $invoiceEntitySaved = (new InvoiceDomainService($this->invoiceRepository))->create(
            $orderInfo,
            $servicesInfo,
            $companyInfo,
            $patientInfo,
        );

        if ($invoiceEntitySaved) {
            //OrderCreatedEvent::dispatch($orderEntitySaved, ['generateInvoice' => $command->getGenerateInvoice()]);
        }

        return $invoiceEntitySaved;
    }
}
