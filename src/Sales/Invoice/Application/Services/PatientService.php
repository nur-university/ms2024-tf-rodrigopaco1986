<?php

namespace Src\Sales\Invoice\Application\Services;

use Src\Sales\Patient\Domain\Entities\Patient;
use Src\Sales\Patient\Domain\Repositories\PatientRepositoryInterface;

class PatientService
{
    private PatientRepositoryInterface $patientRepository;

    public function __construct(PatientRepositoryInterface $patientRepository)
    {
        $this->patientRepository = $patientRepository;
    }

    public function getPatientInfo(string $patientId): Patient
    {
        return $this->patientRepository->findById($patientId);
    }
}
