<?php

namespace Src\Sales\Order\Domain\Exceptions;

use App\Exceptions\DomainException;

class ServiceNotFoundException extends DomainException
{
    public function __construct(private string $serviceId)
    {
        parent::__construct("The service $serviceId was not found!", 422);
    }
}
