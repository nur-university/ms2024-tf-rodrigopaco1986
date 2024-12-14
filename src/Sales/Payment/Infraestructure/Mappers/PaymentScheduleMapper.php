<?php

namespace Src\Sales\Payment\Infraestructure\Mappers;

use Src\Sales\Payment\Domain\Entities\PaymentSchedule as PaymentScheduleEntity;
use Src\Sales\Payment\Domain\ValueObject\PaymentStatus;
use Src\Sales\Payment\Infraestructure\Models\PaymentSchedule as EloquentPaymentSchedule;

class PaymentScheduleMapper
{
    public static function toEntity(EloquentPaymentSchedule $paymentSchedule): PaymentScheduleEntity
    {
        $paymentScheduleEntity = new PaymentScheduleEntity(
            $paymentSchedule->number,
            $paymentSchedule->amount,
            $paymentSchedule->due_date,
            new PaymentStatus($paymentSchedule->status),
            $paymentSchedule->order_id,
        );
        $paymentScheduleEntity->setId($paymentSchedule->id);

        return $paymentScheduleEntity;
    }

    public static function toModel(PaymentScheduleEntity $paymentSchedule): EloquentPaymentSchedule
    {
        $eloquentPaymentScheduleModel = (new EloquentPaymentSchedule)
            ->fill([
                'number' => $paymentSchedule->getNumber(),
                'amount' => $paymentSchedule->getAmount(),
                'due_date' => $paymentSchedule->getDueDate(),
                'status' => $paymentSchedule->getStatus(),
                'order_id' => $paymentSchedule->getOrderId(),
            ]);

        return $eloquentPaymentScheduleModel;
    }
}
