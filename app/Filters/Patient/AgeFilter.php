<?php

namespace App\Filters\Patient;

use App\Models\Patient;
use Closure;

class AgeFilter
{
    public function handle($request, Closure $next)
    {
        if (request()->has('age') === false || empty(request()->get('age'))) {
            return $next($request);
        }

        $query = $next($request);

        foreach (request()->get('age') as $key => $age) {
            $range = Patient::AVAILABLE_AGES[$age];
            if ($key === 0) {
                $query = $query->where(function ($builder) use ($range) {
                    $builder->where(
                        sprintf('%s.%s', Patient::TABLE, Patient::AGE_COLUMN),
                        '>=',
                        $range[0]
                    )->where(
                        sprintf('%s.%s', Patient::TABLE, Patient::AGE_COLUMN),
                        '<=',
                        $range[1]
                    );
                });
            } else {
                $query = $query->orWhere(function ($builder) use ($range) {
                    $builder->where(
                        sprintf('%s.%s', Patient::TABLE, Patient::AGE_COLUMN),
                        '>=',
                        $range[0]
                    )->where(
                        sprintf('%s.%s', Patient::TABLE, Patient::AGE_COLUMN),
                        '<=',
                        $range[1]
                    );
                });
            }
        }

        return $query;
    }
}