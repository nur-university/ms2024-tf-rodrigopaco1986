<?php

namespace Src\Sales\Order\Domain\Exceptions;

use App\Exceptions\DomainException;

class ValueException extends DomainException
{
    public function __construct(private string $msg)
    {
        parent::__construct($msg, 422);
    }
}
