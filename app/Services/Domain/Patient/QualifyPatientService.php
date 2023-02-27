<?php

namespace App\Services\Domain\Patient;

use App\Models\Patient;
use App\Services\Core\Patient\PatientService;

class QualifyPatientService
{
    private PatientService $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    public function qualify(Patient $patient): bool
    {
        $this->patientService->update($patient, [
            Patient::IS_QUALIFIED_COLUMN => true,
        ]);

        return true;
    }
}