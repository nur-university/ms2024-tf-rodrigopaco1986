<?php

namespace Src\Sales\Payment\Domain\Repositories;

use Src\Sales\Payment\Domain\Entities\PaymentSchedule;

interface PaymentScheduleRepositoryInterface
{
    public function findById(string $id): ?PaymentSchedule;

    public function save(PaymentSchedule $paymentSchedule): ?PaymentSchedule;

    public function saveMany(array $paymentSchedule): ?array;
}
