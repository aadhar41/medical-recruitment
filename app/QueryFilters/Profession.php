<?php

namespace App\QueryFilters;

use Closure;

class Profession
{
    public function handle($request, Closure $next)
    {
        // without session
        if ((!request()->has('profession') || !(request()->filled('profession')) || (request()->input('profession') == 0))) {
            return $next($request);
        }

        $profession = (int) request()->input('profession');

        if (!empty($profession)) {
            request()->session()->put('profession', $profession);
        }

        return $next($request)->where('profession', $profession);
    }
}
