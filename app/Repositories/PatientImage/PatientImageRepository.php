<?php

namespace App\Repositories\PatientImage;

use App\Models\PatientImage;
use App\Repositories\AbstractEloquentRepository;

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

    protected function getModelClass(): string
    {
        return PatientImage::class;
    }
}
