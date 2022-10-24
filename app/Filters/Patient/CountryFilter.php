<?php

namespace App\Filters\Patient;

use App\Models\Patient;
use Closure;

class CountryFilter
{
    public function handle($request, Closure $next)
    {
        if (request()->get('country') === null) {
            return $next($request);
        }

        return $next($request)->where(
            sprintf('%s.%s', Patient::TABLE, Patient::COUNTRY_CODE_COLUMN),
            intval(request()->get('country'))
        );
    }
}