<?php

namespace App\Filters\Patient;

use App\Models\Patient;
use Closure;

class WeightFilter
{
    public function handle($request, Closure $next)
    {
        if (request()->has('weight') === false || empty(request()->get('weight'))) {
            return $next($request);
        }

        $query = $next($request);

        foreach (request()->get('weight') as $key => $weight) {
            $range = Patient::AVAILABLE_WEIGHTS[$weight];
            if ($key === 0) {
                $query = $query->where(function ($builder) use ($range) {
                    $builder->where(
                        sprintf('%s.%s', Patient::TABLE, Patient::WEIGHT_COLUMN),
                        '>=',
                        $range[0]
                    )->where(
                        sprintf('%s.%s', Patient::TABLE, Patient::WEIGHT_COLUMN),
                        '<=',
                        $range[1]
                    );
                });
            } else {
                $query = $query->orWhere(function ($builder) use ($range) {
                    $builder->where(
                        sprintf('%s.%s', Patient::TABLE, Patient::WEIGHT_COLUMN),
                        '>=',
                        $range[0]
                    )->where(
                        sprintf('%s.%s', Patient::TABLE, Patient::WEIGHT_COLUMN),
                        '<=',
                        $range[1]
                    );
                });
            }
        }

        return $query;
    }
}