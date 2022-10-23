<?php

namespace App\Filters\Patient;

use App\Models\Patient;
use Closure;

class AgeFilter
{
    public function handle($request, Closure $next)
    {
        if (request()->get('min_age') === null && request()->get('max_age') === null) {
            return $next($request);
        }

        $query = $next($request);

        if (request()->get('min_age') !== null) {
            $query = $query->where(
                sprintf('%s.%s', Patient::TABLE, Patient::AGE_COLUMN),
                '>=',
                request()->get('min_age')
            );
        }

        if (request()->get('max_age') !== null) {
            $query = $query->where(
                sprintf('%s.%s', Patient::TABLE, Patient::AGE_COLUMN),
                '<=',
                request()->get('max_age')
            );
        }

        return $query;
    }
}