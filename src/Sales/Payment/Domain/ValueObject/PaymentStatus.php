<?php

namespace Src\Sales\Payment\Domain\ValueObject;

class PaymentStatus
{
    private const PENDING = 'PENDING';

    private const PAID = 'PAID';

    private string $status;

    public function __construct(string $status = 'PENDING')
    {
        $this->status = $status;
    }

    public static function PENDING(): self
    {
        return new self(self::PENDING);
    }

    public static function PAID(): self
    {
        return new self(self::PAID);
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
