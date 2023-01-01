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

    public function getMalesCount(?Carbon $startDate, ?Carbon $endDate): int
    {
        if ($startDate === null && $endDate === null) {
            return $this->getQueryBuilder()
                ->where(Patient::GENDER_COLUMN, Patient::MALE_GENDER)
                ->count();
        }

        return $this->getQueryBuilder()
            ->where(Patient::GENDER_COLUMN, Patient::MALE_GENDER)
            ->whereDate(Patient::CREATED_AT_COLUMN, '>', $endDate)
            ->count();
    }

    public function getFemalesCount(?Carbon $startDate, ?Carbon $endDate): int
    {
        if ($startDate === null && $endDate === null) {
            return $this->getQueryBuilder()
                ->where(Patient::GENDER_COLUMN, Patient::FEMALE_GENDER)
                ->count();
        }

        return $this->getQueryBuilder()
            ->where(Patient::GENDER_COLUMN, Patient::FEMALE_GENDER)
            ->whereDate(Patient::CREATED_AT_COLUMN, '>', $endDate)
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

        return $this->getQueryBuilder()
            ->select([
                Patient::COUNTRY_CODE_COLUMN,
                DB::raw('count(`' . Patient::COUNTRY_CODE_COLUMN . '`) as counter')
            ])
            ->whereDate(Patient::CREATED_AT_COLUMN, '>', $endDate)
            ->groupBy(Patient::COUNTRY_CODE_COLUMN)
            ->orderBy('counter', 'DESC')
            ->first();
    }

    /**
     * @param int $gender
     * @return Patient[]|Collection
     */
    public function getSubmitsGroupedByCountryAndGender(int $gender): Collection
    {
        return $this->getQueryBuilder()
            ->select([
                Patient::COUNTRY_CODE_COLUMN,
                DB::raw(sprintf('count(%s) as counter', Patient::COUNTRY_CODE_COLUMN)),
            ])
            ->where(Patient::GENDER_COLUMN, $gender)
            ->groupBy(Patient::COUNTRY_CODE_COLUMN)
            ->orderBy('counter', 'DESC')
            ->get();
    }

    public function countAgeBelow(int $number): int
    {
        return $this->getQueryBuilder()
            ->where(Patient::AGE_COLUMN, '<=', $number)
            ->count();
    }

    public function countAgeAbove(int $number): int
    {
        return $this->getQueryBuilder()
            ->where(Patient::AGE_COLUMN, '>=', $number)
            ->count();
    }

    public function getPatientsGroupedBySource(?Carbon $startDate, ?Carbon $endDate)
    {
        if ($endDate === null) {
            return $this->getQueryBuilder()
                ->select([
                    Patient::HEARING_ABOUT_US_SOURCE_COLUMN,
                    DB::raw(sprintf('count(%s) as counter', Patient::HEARING_ABOUT_US_SOURCE_COLUMN)),
                ])
                ->groupBy(Patient::HEARING_ABOUT_US_SOURCE_COLUMN)
                ->orderBy('counter', 'DESC')
                ->get();
        }

        return $this->getQueryBuilder()
            ->select([
                Patient::HEARING_ABOUT_US_SOURCE_COLUMN,
                DB::raw(sprintf('count(%s) as counter', Patient::HEARING_ABOUT_US_SOURCE_COLUMN)),
            ])
            ->whereDate(Patient::CREATED_AT_COLUMN, '>', $endDate)
            ->groupBy(Patient::HEARING_ABOUT_US_SOURCE_COLUMN)
            ->orderBy('counter', 'DESC')
            ->get();
    }

    protected function getModelClass(): string
    {
        return Patient::class;
    }
}
