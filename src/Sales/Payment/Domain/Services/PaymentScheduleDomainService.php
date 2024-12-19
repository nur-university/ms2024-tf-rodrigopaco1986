<?php

namespace Src\Sales\Payment\Domain\Services;

use App\Exceptions\DomainException;
use DateTimeImmutable;
use Exception;
use Src\Sales\Order\Domain\Entities\Order;
use Src\Sales\Payment\Domain\Entities\PaymentSchedule;
use Src\Sales\Payment\Domain\Exceptions\OrderNotFoundException;
use Src\Sales\Payment\Domain\Exceptions\ValueException;
use Src\Sales\Payment\Domain\Repositories\PaymentScheduleRepositoryInterface;
use Src\Sales\Payment\Domain\ValueObject\PaymentStatus;

class PaymentScheduleDomainService
{
    private PaymentScheduleRepositoryInterface $paymentScheduleRepository;

    public function __construct(
        PaymentScheduleRepositoryInterface $paymentScheduleRepository,
    ) {
        $this->paymentScheduleRepository = $paymentScheduleRepository;
    }

    public function create(Order $orderInfo, int $paymentInstallments, string $orderId): ?array
    {
        if (! $orderInfo->getId()) {
            throw new OrderNotFoundException($orderId);
        }

        if ($paymentInstallments <= 0) {
            throw new ValueException('Payment installments must be grather than 0.');
        }

        if ($paymentInstallments >= 12) {
            throw new ValueException('Payment installments must be less than 12 (a year of service).');
        }

        $payments = [];
        $amount = $orderInfo->getTotal() / $paymentInstallments;
        $date = new DateTimeImmutable;

        for ($i = 1; $i <= $paymentInstallments; $i++) {
            $date = $date->modify('+1 month');
            $paymentSchedule = new PaymentSchedule(
                $i,
                $amount,
                $date,
                PaymentStatus::PENDING(),
                $orderInfo->getId(),
            );
            $payments[] = $paymentSchedule;
        }

        try {

            $paymentsEntitiesSaved = $this->paymentScheduleRepository->saveMany($payments);

            return $paymentsEntitiesSaved;

        } catch (Exception $e) {
            throw new DomainException('Error saving payment schedule');
        }

    }
}
