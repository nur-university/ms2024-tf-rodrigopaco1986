<?php

namespace Src\Sales\Payment\Domain\Entities;

use DateTimeImmutable;
use Src\Sales\Payment\Domain\ValueObject\PaymentStatus;

class PaymentSchedule
{
    private string $id;

    public function __construct(
        private int $number,
        private float $amount,
        private DateTimeImmutable $dueDate,
        private PaymentStatus $status,
        private string $orderId,
    ) {}

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
     * Get the value of number
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Get the value of dueDate
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Get the value of amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status->getStatus();
    }

    /**
     * Get the value of orderId
     */
    public function getOrderId()
    {
        return $this->orderId;
    }
}
