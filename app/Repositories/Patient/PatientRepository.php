<?php

namespace App\Repositories\Patient;

use App\Models\Patient;
use App\Repositories\AbstractEloquentRepository;

class PatientRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?Patient
    {
    }

    public function create(array $attributes): Patient
    {
        return $this->getQueryBuilder()
            ->create($attributes);
    }

    public function findByEmail(string $email): ?Patient
    {
        return $this->getQueryBuilder()
            ->where(Patient::EMAIL_COLUMN, $email)
            ->first();
    }

    protected function getModelClass(): string
    {
        return Patient::class;
    }
}
