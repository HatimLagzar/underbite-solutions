<?php

namespace App\Services\Core\Patient;

use App\Models\Patient;
use App\Repositories\Patient\PatientRepository;

class PatientService
{
    private PatientRepository $patientRepository;

    public function __construct(PatientRepository $patientRepository)
    {
        $this->patientRepository = $patientRepository;
    }

    public function findById(string $id): ?Patient
    {
    }

    public function create(array $attributes): Patient
    {
        return $this->patientRepository->create($attributes);
    }

    public function findByEmail(string $email): ?Patient
    {
        return $this->patientRepository->findByEmail($email);
    }
}
