<?php

namespace App\Exceptions;

use Exception;

class DomainException extends Exception
{
    protected int $statusCode = 422;

    public function __construct(string $message, int $statusCode = 422)
    {
        parent::__construct($message);
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
