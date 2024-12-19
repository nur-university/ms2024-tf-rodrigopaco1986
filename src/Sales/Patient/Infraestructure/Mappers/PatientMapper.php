<?php

namespace Src\Sales\Patient\Infraestructure\Mappers;

use Src\Sales\Patient\Domain\Entities\Patient as PatientEntity;

class PatientMapper
{
    public static function toEntity(object $patient): PatientEntity
    {
        $patientEntity = new PatientEntity(
            $patient->code,
            $patient->name,
            $patient->nit,
            $patient->address,
            $patient->phone,
            $patient->email,
        );
        $patientEntity->setId($patient->id);

        return $patientEntity;
    }
}
