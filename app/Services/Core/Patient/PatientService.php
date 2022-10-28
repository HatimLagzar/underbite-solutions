<?php

namespace App\Services\Core\Patient;

use App\Models\Patient;
use App\Models\PatientImage;
use App\Repositories\Country\CountryRepository;
use App\Repositories\Patient\PatientRepository;
use App\Repositories\PatientImage\PatientImageRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PatientService
{
    private PatientRepository $patientRepository;
    private PatientImageRepository $patientImageRepository;
    private CountryRepository $countryRepository;

    public function __construct(
        PatientRepository $patientRepository,
        PatientImageRepository $patientImageRepository,
        CountryRepository $countryRepository
    ) {
        $this->patientRepository = $patientRepository;
        $this->patientImageRepository = $patientImageRepository;
        $this->countryRepository = $countryRepository;
    }

    public function create(array $attributes): Patient
    {
        return $this->patientRepository->create($attributes);
    }

    public function findByEmail(string $email): ?Patient
    {
        return $this->patientRepository->findByEmail($email);
    }

    /**
     * @return Patient[]|Collection
     */
    public function getAll(): Collection
    {
        return $this->patientRepository->getAll()->transform(function (Patient $patient) {
            return $this->hydrate($patient);
        });
    }

    public function hydrate(Patient $patient): Patient
    {
        $images = $this->patientImageRepository->getAllByPatient($patient->getId());
        $patient->setImages($images);

        $rightSideImage = $images->filter(function (PatientImage $patientImage) {
            return $patientImage->getPosition() === PatientImage::RIGHT_VIEW;
        })->first();

        $patient->setRightSideImage($rightSideImage);

        $country = $this->countryRepository->findByCode($patient->getCountryCode());
        $patient->setCountry($country);

        return $patient;
    }

    public function findById(int $id): ?Patient
    {
        return $this->patientRepository->findById($id);
    }

    public function update(Patient $patient, array $attributes): bool
    {
        return $this->patientRepository->update($patient->getId(), $attributes);
    }

    public function getQuery(): Builder
    {
        return $this->patientRepository->getQueryBuilder();
    }

    public function getMalesCount(): int
    {
        return $this->patientRepository->getMalesCount();
    }

    public function getFemalesCount(): int
    {
        return $this->patientRepository->getFemalesCount();
    }

    /**
     * @param int $limit
     * @return Patient[]|Collection
     */
    public function getRecentApplications(int $limit): Collection
    {
        return $this->patientRepository->getRecentApplications($limit)
            ->transform(function (Patient $patient) {
                return $this->hydrate($patient);
            });
    }

    public function getTopCountryPatients(?Carbon $startDate, ?Carbon $endDate)
    {
        $result = $this->patientRepository->getTopCountryPatients($startDate, $endDate);
        if ($result !== null) {
            $result->country = $this->countryRepository->findByCode($result->country_code);
        }


        return $result;
    }
}
