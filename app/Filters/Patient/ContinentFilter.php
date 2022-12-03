<?php

namespace App\Filters\Patient;

use App\Models\Country;
use App\Models\Patient;
use App\Services\Core\Country\CountryService;
use Closure;

class ContinentFilter
{
    private CountryService $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function handle($request, Closure $next)
    {
        if (request()->has('continent') === false || empty(request()->get('continent'))) {
            return $next($request);
        }

        return $next($request)->where(function ($builder) {
            foreach (request()->get('continent') as $key => $continentId) {
                $countriesByContinent = $this->countryService->getAllByContinent($continentId);
                $countriesIds = $countriesByContinent->transform(fn (Country $country) => $country->getCode());

                if ($key === 0) {
                    $builder->whereIn(
                        sprintf('%s.%s', Patient::TABLE, Patient::COUNTRY_CODE_COLUMN),
                        $countriesIds
                    );
                } else {
                    $builder->orWhereIn(
                        sprintf('%s.%s', Patient::TABLE, Patient::COUNTRY_CODE_COLUMN),
                        $countriesIds
                    );
                }
            }
        });
    }
}