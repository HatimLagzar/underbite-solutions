<?php

namespace App\Filters\Patient;

use App\Models\Patient;
use Closure;

class QualifiedFilter
{
    public function handle($request, Closure $next)
    {
        if (request()->get('is_qualified') === null) {
            return $next($request);
        }

        if (boolval(request()->get('is_qualified')) === false) {
            return $next($request)->where(function ($query) {
                return $query->where(
                    sprintf('%s.%s', Patient::TABLE, Patient::IS_QUALIFIED_COLUMN),
                    false
                )
                    ->orWhereNull(
                        sprintf('%s.%s', Patient::TABLE, Patient::IS_QUALIFIED_COLUMN)
                    );
            });
        }

        return $next($request)->where(
            sprintf('%s.%s', Patient::TABLE, Patient::IS_QUALIFIED_COLUMN),
            boolval(request()->get('is_qualified'))
        );
    }
}