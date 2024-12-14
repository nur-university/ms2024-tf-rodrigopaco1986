<?php

namespace Src\Sales\Order\Domain\Exceptions;

use App\Exceptions\DomainException;

class OrderNotCreatedException extends DomainException
{
    public function __construct()
    {
        parent::__construct('The order was not created.', 422);
    }
}
