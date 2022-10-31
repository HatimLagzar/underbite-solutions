<?php

namespace App\Services\Domain\Patient;

use App\Filters\Patient\AgeFilter;
use App\Filters\Patient\ContinentFilter;
use App\Filters\Patient\CountryFilter;
use App\Filters\Patient\GenderFilter;
use App\Filters\Patient\HeightFilter;
use App\Filters\Patient\QualifiedFilter;
use App\Filters\Patient\WeightFilter;
use App\Models\Patient;
use App\Services\Core\Patient\PatientService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pipeline\Pipeline;

class FilterService
{
    private PatientService $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    /**
     * @return Collection|Patient[]
     */
    public function filter($query = null): Collection
    {
        if (!$query) {
            $query = $this->patientService->getQuery();
        }

        $applications = app(Pipeline::class)
            ->send($query)
            ->through([
                HeightFilter::class,
                WeightFilter::class,
                AgeFilter::class,
                GenderFilter::class,
                CountryFilter::class,
                ContinentFilter::class
            ])
            ->thenReturn()
            ->get();

        return $applications->transform(function (Patient $patient) {
            return $this->patientService->hydrate($patient);
        });
    }
}