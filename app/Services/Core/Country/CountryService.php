<?php

namespace App\Services\Core\Country;

use App\Models\Country;
use App\Repositories\Country\CountryRepository;
use Illuminate\Database\Eloquent\Collection;

class CountryService
{
    private CountryRepository $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * @return Country[]|Collection
     */
    public function getAll(): Collection
    {
        return $this->countryRepository->getAll();
    }

    /**
     * @param string $continent
     * @return Country[]|Collection
     */
    public function getAllByContinent(string $continent): Collection
    {
        return $this->countryRepository->getAllByContinent($continent);
    }

    public function findByCountryCode(string $countryCode): ?Country
    {
        return $this->countryRepository->findByCountryCode($countryCode);
    }
}
