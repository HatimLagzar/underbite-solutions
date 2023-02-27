<?php

namespace App\Filters\Patient;

use App\Models\Patient;
use Closure;

class WeightFilter
{
    public function handle($request, Closure $next)
    {
        if (request()->has('weight') === false || empty(request()->get('weight')) || request()->get('weight')[0] === null) {
            return $next($request);
        }

        return $next($request)->where(function ($builder1) {
            foreach (request()->get('weight') as $key => $weight) {
                $range = Patient::AVAILABLE_WEIGHTS[$weight];
                if ($key === 0) {
                    $builder1->where(function ($builder) use ($range) {
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
                    $builder1->orWhere(function ($builder) use ($range) {
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
        });
    }
}