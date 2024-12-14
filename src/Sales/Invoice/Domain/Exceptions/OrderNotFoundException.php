<?php

namespace Src\Sales\Invoice\Domain\Exceptions;

use App\Exceptions\DomainException;

class OrderNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct('The order was not found!', 404);
    }
}
