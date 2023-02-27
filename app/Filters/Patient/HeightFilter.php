<?php

namespace App\Filters\Patient;

use App\Models\Patient;
use Closure;

class HeightFilter
{
    public function handle($request, Closure $next)
    {
        if (request()->has('height') === false || empty(request()->get('height')) || request()->get('height')[0] === null) {
            return $next($request);
        }

        return $next($request)->where(function ($builder1) {
            foreach (request()->get('height') as $key => $height) {
                $range = Patient::AVAILABLE_HEIGHTS[$height];
                if ($key === 0) {
                    $builder1->where(function ($builder) use ($range) {
                        $builder->where(
                            sprintf('%s.%s', Patient::TABLE, Patient::HEIGHT_COLUMN),
                            '>=',
                            $range[0]
                        )->where(
                            sprintf('%s.%s', Patient::TABLE, Patient::HEIGHT_COLUMN),
                            '<=',
                            $range[1]
                        );
                    });
                } else {
                    $builder1->orWhere(function ($builder) use ($range) {
                        $builder->where(
                            sprintf('%s.%s', Patient::TABLE, Patient::HEIGHT_COLUMN),
                            '>=',
                            $range[0]
                        )->where(
                            sprintf('%s.%s', Patient::TABLE, Patient::HEIGHT_COLUMN),
                            '<=',
                            $range[1]
                        );
                    });
                }
            }
        });
    }
}