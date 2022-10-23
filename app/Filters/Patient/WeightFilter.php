<?php

namespace App\Filters\Patient;

use App\Models\Patient;
use Closure;

class WeightFilter
{
    public function handle($request, Closure $next)
    {
        if (request()->get('min_weight') === null && request()->get('max_weight') === null) {
            return $next($request);
        }

        $query = $next($request);

        if (request()->get('min_weight') !== null) {
            $query = $query->where(
                sprintf('%s.%s', Patient::TABLE, Patient::WEIGHT_COLUMN),
                '>=',
                intval(request()->get('min_weight'))
            );
        }

        if (request()->get('max_weight') !== null) {
            $query = $query->where(
                sprintf('%s.%s', Patient::TABLE, Patient::WEIGHT_COLUMN),
                '<=',
                intval(request()->get('max_weight'))
            );
        }

        return $query;
    }
}