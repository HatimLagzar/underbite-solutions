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

    public function getMalesCount(): int
    {
        return $this->getQueryBuilder()
            ->where(Patient::GENDER_COLUMN, Patient::MALE_GENDER)
            ->count();
    }

    public function getFemalesCount(): int
    {
        return $this->getQueryBuilder()
            ->where(Patient::GENDER_COLUMN, Patient::FEMALE_GENDER)
            ->count();
    }

    /**
     * @param int $limit
     * @return Patient[]|Collection
     */
    public function getRecentApplications(int $limit): Collection
    {
        return $this->getQueryBuilder()
            ->latest()
            ->limit($limit)
            ->get();
    }

    protected function getModelClass(): string
    {
        return Patient::class;
    }
}
