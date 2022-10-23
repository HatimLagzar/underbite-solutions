<?php

namespace App\Filters\Patient;

use App\Models\Patient;
use Closure;

class HeightFilter
{
    public function handle($request, Closure $next)
    {
        if (request()->get('min_height') === null && request()->get('max_height') === null) {
            return $next($request);
        }

        $query = $next($request);

        if (request()->get('min_height') !== null) {
            $query = $query->where(
                sprintf('%s.%s', Patient::TABLE, Patient::HEIGHT_COLUMN),
                '>=',
                request()->get('min_height')
            );
        }

        if (request()->get('max_height') !== null) {
            $query = $query->where(
                sprintf('%s.%s', Patient::TABLE, Patient::HEIGHT_COLUMN),
                '<=',
                request()->get('max_height')
            );
        }

        return $query;
    }
}