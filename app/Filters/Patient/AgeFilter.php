<?php

namespace App\Filters\Patient;

use App\Models\Patient;
use Closure;

class AgeFilter
{
    public function handle($request, Closure $next)
    {
        if (request()->has('age') === false || empty(request()->get('age')) || request()->get('age')[0] === null) {
            return $next($request);
        }

        return $next($request)->where(function ($builder1) {
            foreach (request()->get('age') as $key => $age) {
                $range = Patient::AVAILABLE_AGES[$age];
                if ($key === 0) {
                    $builder1->where(function ($builder) use ($range) {
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
                    $builder1->orWhere(function ($builder) use ($range) {
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
        });
    }
}