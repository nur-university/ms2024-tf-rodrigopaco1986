<?php

namespace Src\Sales\Invoice\Application\Commands;

class CreateInvoiceCommand
{
    public function __construct(
        private string $orderId,
        private string $customerId,
    ) {}

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

    /**
     * Get the value of customerId
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set the value of customerId
     *
     * @return self
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }
}
