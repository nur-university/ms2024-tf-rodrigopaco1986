<?php

namespace Src\Sales\Invoice\Domain\Exceptions;

use App\Exceptions\DomainException;

class InvoiceAlredyCreatedException extends DomainException
{
    public function __construct()
    {
        parent::__construct('The invoice was already created!', 404);
    }
}
