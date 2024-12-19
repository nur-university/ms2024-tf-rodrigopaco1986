<?php

namespace Src\Sales\Payment\Application\Commands\Handlers;

use Src\Sales\Payment\Application\Commands\CreatePaymentScheduleCommand;
//use Src\Sales\Payment\Domain\Events\OrderCreatedEvent;
use Src\Sales\Payment\Application\Services\OrderService;
use Src\Sales\Payment\Domain\Repositories\PaymentScheduleRepositoryInterface;
use Src\Sales\Payment\Domain\Services\PaymentScheduleDomainService;

final class CreatePaymentScheduleCommandHandler
{
    private PaymentScheduleRepositoryInterface $paymentScheduleRepository;

    private OrderService $orderService;

    public function __construct(PaymentScheduleRepositoryInterface $paymentScheduleRepository, OrderService $orderService)
    {
        $this->paymentScheduleRepository = $paymentScheduleRepository;
        $this->orderService = $orderService;
    }

    public function handle(CreatePaymentScheduleCommand $command): ?array
    {
        $orderInfo = $this->orderService->getOrderInfo($command->getOrderId());
        $paymentScheduleEntitiesSaved = (new PaymentScheduleDomainService($this->paymentScheduleRepository))
            ->create(
                $orderInfo,
                $command->getPaymentInstallments(),
                $command->getOrderId(),
            );

        if ($paymentScheduleEntitiesSaved) {
            //OrderCreatedEvent::dispatch($orderEntitySaved, ['generateInvoice' => $command->getGenerateInvoice()]);
        }

        return $paymentScheduleEntitiesSaved;
    }
}
