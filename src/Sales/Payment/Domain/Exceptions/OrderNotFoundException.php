<?php

namespace Src\Sales\Payment\Domain\Exceptions;

use App\Exceptions\DomainException;

class OrderNotFoundException extends DomainException
{
    public function __construct(private string $orderId)
    {
        parent::__construct("The order $orderId was not found!", 404);
    }
}
