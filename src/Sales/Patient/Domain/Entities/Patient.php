<?php

namespace Src\Sales\Patient\Domain\Entities;

class Patient
{
    private string $id;

    public function __construct(
        private string $code,
        private string $name,
        private string $nit,
        private string $address,
        private string $phone,
        private string $email,
    ) {}

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of code
     */
    public function getCode()
    {
        return $this->code;
    }

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

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }
}
