<?php

namespace App\Repositories\Country;

use App\Models\Country;
use App\Repositories\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Collection;

class CountryRepository extends AbstractEloquentRepository
{
    /**
     * @return Country[]|Collection
     */
    public function getAll(): Collection
    {
        return $this->getQueryBuilder()
                    ->orderBy(Country::NAME_COLUMN, 'ASC')
                    ->get();
    }

    public function findByCode(string $countryCode): ?Country
    {
        return $this->getQueryBuilder()
                    ->where(Country::CODE_COLUMN, $countryCode)
                    ->first();
    }

    /**
     * @param string $continent
     * @return Country[]|Collection
     */
    public function getAllByContinent(string $continent): Collection
    {
        return $this->getQueryBuilder()
            ->where(Country::CONTINENT_CODE_COLUMN, $continent)
            ->get();
    }

    public function findByCountryCode(string $countryCode): ?Country
    {
        return $this->getQueryBuilder()
            ->where(Country::CODE_COLUMN, $countryCode)
            ->first();
    }

    public function findByISO3(string $code): ?Country
    {
        return $this->getQueryBuilder()
            ->where(Country::ISO3_COLUMN, $code)
            ->first();
    }

    protected function getModelClass(): string
    {
        return Country::class;
    }
}
