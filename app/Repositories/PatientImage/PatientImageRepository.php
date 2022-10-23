<?php

namespace App\Repositories\PatientImage;

use App\Models\PatientImage;
use App\Repositories\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Collection;

class PatientImageRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?PatientImage
    {
    }

    public function create(array $attributes): PatientImage
    {
        return $this->getQueryBuilder()
            ->create($attributes);
    }

    /**
     * @param int $patientId
     * @return PatientImage[]|Collection
     */
    public function getAllByPatient(int $patientId): Collection
    {
        return $this->getQueryBuilder()
            ->where(PatientImage::PATIENT_ID_COLUMN, $patientId)
            ->get();
    }

    protected function getModelClass(): string
    {
        return PatientImage::class;
    }
}
