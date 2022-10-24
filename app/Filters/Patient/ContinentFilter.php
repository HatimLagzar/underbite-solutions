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
        if (request()->get('continent') === null) {
            return $next($request);
        }

        $countriesByContinent = $this->countryService->getAllByContinent(request()->get('continent'));
        $countriesIds = $countriesByContinent->transform(fn (Country $country) => $country->getCode());

        return $next($request)->whereIn(
            sprintf('%s.%s', Patient::TABLE, Patient::COUNTRY_CODE_COLUMN),
            $countriesIds
        );
    }
}