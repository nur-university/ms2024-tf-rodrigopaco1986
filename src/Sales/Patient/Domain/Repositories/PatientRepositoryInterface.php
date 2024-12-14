<?php

namespace Src\Sales\Patient\Domain\Repositories;

use Src\Sales\Patient\Domain\Entities\Patient;

interface PatientRepositoryInterface
{
    public function findById(string $id): Patient;
}
