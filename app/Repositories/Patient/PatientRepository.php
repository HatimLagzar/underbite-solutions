<?php

namespace App\Repositories\Patient;

use App\Models\Patient;
use App\Repositories\AbstractEloquentRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

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

    public function getTopCountryPatients(?Carbon $startDate, ?Carbon $endDate)
    {
        if ($startDate === null && $endDate === null) {
            return $this->getQueryBuilder()
                ->select([
                    Patient::COUNTRY_CODE_COLUMN,
                    DB::raw('count(`' . Patient::COUNTRY_CODE_COLUMN . '`) as counter')
                ])
                ->groupBy(Patient::COUNTRY_CODE_COLUMN)
                ->orderBy('counter', 'DESC')
                ->first();
        }
    }

    protected function getModelClass(): string
    {
        return Patient::class;
    }
}
