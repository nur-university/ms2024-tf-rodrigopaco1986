<?php

namespace Src\Sales\Payment\Infraestructure\Repositories;

use Src\Sales\Payment\Domain\Entities\PaymentSchedule;
use Src\Sales\Payment\Domain\Repositories\PaymentScheduleRepositoryInterface;
use Src\Sales\Payment\Infraestructure\Mappers\PaymentScheduleMapper;
use Src\Sales\Payment\Infraestructure\Models\PaymentSchedule as EloquentPaymentSchedule;

class PaymentScheduleRepository implements PaymentScheduleRepositoryInterface
{
    public function findById(string $id): ?PaymentSchedule
    {
        $eloquentPaymentSchedule = EloquentPaymentSchedule::find($id);

        if ($eloquentPaymentSchedule) {
            return PaymentScheduleMapper::toEntity($eloquentPaymentSchedule);
        }

        return null;
    }

    public function save(PaymentSchedule $paymentSchedule): ?PaymentSchedule
    {
        $eloquentPaymentScheduleModel = PaymentScheduleMapper::toModel($paymentSchedule);
        $eloquentPaymentScheduleModel->save();

        return PaymentScheduleMapper::toEntity($eloquentPaymentScheduleModel);
    }

    public function saveMany(array $paymentSchedules): ?array
    {
        $response = [];

        foreach ($paymentSchedules as $paymentSchedule) {
            $eloquentPaymentScheduleModel = PaymentScheduleMapper::toModel($paymentSchedule);
            $eloquentPaymentScheduleModel->save();
            $response[] = PaymentScheduleMapper::toEntity($eloquentPaymentScheduleModel);
        }

        return $response;
    }
}
