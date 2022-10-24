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
                    ->get();
    }

    public function findByCode(string $countryCode): ?Country
    {
        return $this->getQueryBuilder()
                    ->where(Country::CODE_COLUMN, $countryCode)
                    ->first();
    }

    protected function getModelClass(): string
    {
        return Country::class;
    }
}
