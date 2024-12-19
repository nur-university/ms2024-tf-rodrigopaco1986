<?php

namespace Src\Sales\Invoice\Domain\Exceptions;

use App\Exceptions\DomainException;

class PatientNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct('The patient was not found!', 404);
    }
}
