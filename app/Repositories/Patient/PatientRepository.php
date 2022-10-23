<?php

namespace App\Repositories\Patient;

use App\Models\Patient;
use App\Repositories\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Collection;

class PatientRepository extends AbstractEloquentRepository
{
    public function findById(string $id): ?Patient
    {
        return $this->getQueryBuilder()
            ->where(Patient::ID_COLUMN, $id)
            ->first();
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

    /**
     * @return Patient[]|Collection
     */
    public function getAll(): Collection
    {
        return $this->getQueryBuilder()
            ->get();
    }

    public function update(int $id, array $attributes): bool
    {
        return $this->getQueryBuilder()
            ->where(Patient::ID_COLUMN, $id)
            ->update($attributes) > 0;
    }

    protected function getModelClass(): string
    {
        return Patient::class;
    }
}
