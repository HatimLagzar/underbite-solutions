<?php

namespace App\Services\Core\PatientImage;

use App\Models\PatientImage;
use App\Repositories\PatientImage\PatientImageRepository;

class PatientImageService
{
    private PatientImageRepository $patientImageRepository;

    public function __construct(PatientImageRepository $patientImageRepository)
    {
        $this->patientImageRepository = $patientImageRepository;
    }

    public function findById(string $id): ?PatientImage
    {
    }

    public function create(array $attributes): PatientImage
    {
        return $this->patientImageRepository->create($attributes);
    }
}
