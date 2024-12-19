<?php

namespace Src\Sales\Payment\Domain\ValueObject;

class PaymentType
{
    private const CASH = 'CASH';

    private const CARD = 'CARD';

    private const QR = 'QR';

    private string $status;

    public function __construct(string $status = 'CASH')
    {
        $this->status = $status;
    }

    public static function CASH(): self
    {
        return new self(self::CASH);
    }

    public static function CARD(): self
    {
        return new self(self::CARD);
    }

    public static function QR(): self
    {
        return new self(self::QR);
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
