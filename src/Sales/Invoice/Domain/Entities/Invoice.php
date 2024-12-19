<?php

namespace Src\Sales\Invoice\Domain\Entities;

use DateTimeImmutable;
use Src\Sales\Invoice\Domain\ValueObject\InvoiceStatus;

class Invoice
{
    private string $id;

    public function __construct(
        private string $nit,
        private int $number,
        private string $authorizationCode,
        private DateTimeImmutable $invoiceDate,
        private string $customerId,
        private int $customerCode,
        private string $customerName,
        private string $customerNit,
        private InvoiceStatus $status,
        private string $orderId,
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
     * Get the value of nit
     */
    public function getNit()
    {
        return $this->nit;
    }

    /**
     * Get the value of number
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Get the value of authorizationCode
     */
    public function getAuthorizationCode()
    {
        return $this->authorizationCode;
    }

    /**
     * Get the value of invoiceDate
     */
    public function getInvoiceDate()
    {
        return $this->invoiceDate;
    }

    /**
     * Get the value of customerId
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Get the value of customerCode
     */
    public function getCustomerCode()
    {
        return $this->customerCode;
    }

    /**
     * Get the value of customerName
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * Get the value of customerNit
     */
    public function getCustomerNit()
    {
        return $this->customerNit;
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
        return collect($this->items)->sum(function (InvoiceItem $invoiceItem) {
            return $invoiceItem->getSubTotal();
        });
    }

    public function addItem(InvoiceItem $invoiceItem): void
    {
        $this->items[] = $invoiceItem;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Get the value of orderId
     */
    public function getOrderId()
    {
        return $this->orderId;
    }
}
