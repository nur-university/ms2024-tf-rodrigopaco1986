<?php

namespace Src\Sales\Invoice\Domain\Exceptions;

use App\Exceptions\DomainException;

class InvoiceAlredyCreatedException extends DomainException
{
    public function __construct()
    {
        parent::__construct('The order was not already created!', 404);
    }
}
