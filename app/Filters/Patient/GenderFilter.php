<?php

namespace App\Filters\Patient;

use App\Models\Patient;
use Closure;

class GenderFilter
{
    public function handle($request, Closure $next)
    {
        if (request()->get('gender') === null) {
            return $next($request);
        }

        return $next($request)->where(
            sprintf('%s.%s', Patient::TABLE, Patient::GENDER_COLUMN),
            intval(request()->get('gender'))
        );
    }
}