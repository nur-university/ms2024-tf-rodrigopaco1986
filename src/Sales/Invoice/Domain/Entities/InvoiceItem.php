<?php

namespace Src\Sales\Invoice\Domain\Entities;

use Exception;

class InvoiceItem
{
    private string $id;

    public function __construct(
        private string $serviceId,
        private string $serviceCode,
        private string $serviceName,
        private string $serviceUnit,
        private int $quantity,
        private float $price,
        private float $discount,
    ) {
        if ($this->quantity < 0) {
            throw new Exception('Invoice Item: Quantity cant be lower than zero');
        }

        if ($this->price < 0) {
            throw new Exception('Invoice Item: Price cant be lower than zero');
        }

        if ($this->discount < 0) {
            throw new Exception('Invoice Item: Discount cant be lower than zero');
        }
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of serviceId
     */
    public function getServiceId()
    {
        return $this->serviceId;
    }

    /**
     * Get the value of serviceCode
     */
    public function getServiceCode()
    {
        return $this->serviceCode;
    }

    /**
     * Get the value of serviceName
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }

    /**
     * Get the value of serviceUnit
     */
    public function getServiceUnit()
    {
        return $this->serviceUnit;
    }

    public function getSubTotal(): float
    {
        return ($this->quantity * $this->price) - $this->discount;
    }

    /**
     * Get the value of quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get the value of discount
     */
    public function getDiscount()
    {
        return $this->discount;
    }
}
