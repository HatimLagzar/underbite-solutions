<?php

namespace App\Services\Domain\Patient;

use App\Models\Patient;
use App\Services\Core\Patient\PatientService;

class UnqualifyPatientService
{
    private PatientService $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    public function unqualify(Patient $patient): bool
    {
        $this->patientService->update($patient, [
            Patient::IS_QUALIFIED_COLUMN => false,
        ]);

        return true;
    }
}