<?php

namespace App\Filters\Patient;

use App\Models\Patient;
use Closure;

class CountryFilter
{
    public function handle($request, Closure $next)
    {
        if (request()->has('country') === false || empty(request()->get('country')) || request()->get('country')[0] === null) {
            return $next($request);
        }

        return $next($request)->where(function ($builder) {
            foreach (request()->get('country') as $key => $countryCode) {
                if ($key === 0) {
                    $builder->where(
                        sprintf('%s.%s', Patient::TABLE, Patient::COUNTRY_CODE_COLUMN),
                        $countryCode
                    );
                } else {
                    $builder->orWhere(
                        sprintf('%s.%s', Patient::TABLE, Patient::COUNTRY_CODE_COLUMN),
                        $countryCode
                    );
                }
            }
        });
    }
}