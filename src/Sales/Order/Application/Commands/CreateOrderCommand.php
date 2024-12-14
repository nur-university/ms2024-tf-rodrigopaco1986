<?php

namespace Src\Sales\Order\Application\Commands;

class CreateOrderCommand
{
    public function __construct(
        private string $patientId,
        private array $items,
        private int $paymentInstallments,
        private bool $generateInvoice,
    ) {}

    /**
     * Get the value of patientId
     */
    public function getPatientId()
    {
        return $this->patientId;
    }

    /**
     * Set the value of patientId
     *
     * @return self
     */
    public function setPatientId($patientId)
    {
        $this->patientId = $patientId;

        return $this;
    }

    /**
     * Get the value of items
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set the value of items
     *
     * @return self
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Get the value of generateInvoice
     */
    public function getGenerateInvoice()
    {
        return $this->generateInvoice;
    }

    /**
     * Set the value of generateInvoice
     *
     * @return self
     */
    public function setGenerateInvoice($generateInvoice)
    {
        $this->generateInvoice = $generateInvoice;

        return $this;
    }

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
}
