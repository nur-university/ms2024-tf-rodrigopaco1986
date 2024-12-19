<?php

namespace Src\Sales\Order\Domain\Entities;

use DateTimeImmutable;
use Src\Sales\Order\Domain\ValueObject\OrderStatus;

class Order
{
    private string $id;

    public function __construct(
        private string $patientId,
        private DateTimeImmutable $orderDate,
        private OrderStatus $status,
        private array $items = [],
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
     * Get the value of patientId
     */
    public function getPatientId()
    {
        return $this->patientId;
    }

    /**
     * Get the value of orderDate
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status->getStatus();
    }

    public function getTotal(): float
    {
        return collect($this->items)->sum(function (OrderItem $orderItem) {
            return $orderItem->getSubTotal();
        });
    }

    public function addItem(OrderItem $orderItem): void
    {
        $this->items[] = $orderItem;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
