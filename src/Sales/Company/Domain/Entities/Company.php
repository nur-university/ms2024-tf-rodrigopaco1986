<?php

namespace Src\Sales\Company\Domain\Entities;

class Company
{
    public function __construct(
        private string $name,
        private string $nit,
        private string $authorizationCode,
        private string $address,
        private string $phone,
    ) {}

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of nit
     */
    public function getNit()
    {
        return $this->nit;
    }

    /**
     * Get the value of authorizationCode
     */
    public function getAuthorizationCode()
    {
        return $this->authorizationCode;
    }

    /**
     * Get the value of address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get the value of phone
     */
    public function getPhone()
    {
        return $this->phone;
    }
}
