<?php

namespace Src\Sales\Service\Domain\Entities;

class Service
{
    private string $id;

    public function __construct(
        private string $code,
        private string $name,
        private string $unit,
        private string $description,
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
     * Get the value of unit
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }
}
