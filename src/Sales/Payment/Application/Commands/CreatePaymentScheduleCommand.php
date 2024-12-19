<?php

namespace Src\Sales\Payment\Application\Commands;

class CreatePaymentScheduleCommand
{
    public function __construct(
        private string $orderId,
        private string $paymentInstallments,
    ) {}

    /**
     * Get the value of paymentInstallments
     */
    public function getPaymentInstallments()
    {
        return $this->paymentInstallments;
    }

    /**
     * Set the value of paymentInstallments
     *
     * @return self
     */
    public function setPaymentInstallments($paymentInstallments)
    {
        $this->paymentInstallments = $paymentInstallments;

        return $this;
    }

    /**
     * Get the value of orderId
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set the value of orderId
     *
     * @return self
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }
}
