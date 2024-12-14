<?php

namespace Src\Sales\Payment\Infraestructure\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        try {
            return DB::transaction(function () use ($paymentSchedule) {
                $eloquentPaymentScheduleModel = PaymentScheduleMapper::toModel($paymentSchedule);
                $eloquentPaymentScheduleModel->save();

                return PaymentScheduleMapper::toEntity($eloquentPaymentScheduleModel);
            });
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return null;
    }

    public function saveMany(array $paymentSchedules): ?array
    {
        try {
            return DB::transaction(function () use ($paymentSchedules) {
                $response = [];

                foreach ($paymentSchedules as $paymentSchedule) {
                    $eloquentPaymentScheduleModel = PaymentScheduleMapper::toModel($paymentSchedule);
                    $eloquentPaymentScheduleModel->save();
                    $response[] = PaymentScheduleMapper::toEntity($eloquentPaymentScheduleModel);
                }

                return $response;
            });
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return null;
    }
}
