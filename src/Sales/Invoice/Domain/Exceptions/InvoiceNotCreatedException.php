<?php

namespace Src\Sales\Invoice\Domain\Exceptions;

use App\Exceptions\DomainException;

class InvoiceNotCreatedException extends DomainException
{
    public function __construct()
    {
        parent::__construct('The invoice was not created.', 422);
    }
}
