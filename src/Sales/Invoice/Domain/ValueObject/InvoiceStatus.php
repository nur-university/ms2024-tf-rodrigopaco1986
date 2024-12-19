<?php

namespace Src\Sales\Invoice\Domain\ValueObject;

class InvoiceStatus
{
    private const CREATED = 'CREATED';

    private const CANCELLED = 'CANCELLED';

    private string $status;

    public function __construct(string $status)
    {
        $this->status = $status;
    }

    public static function CREATED(): self
    {
        return new self(self::CREATED);
    }

    public static function CANCELLED(): self
    {
        return new self(self::CANCELLED);
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
