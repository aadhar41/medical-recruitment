<?php

namespace App\QueryFilters;

use Closure;

class Specialty
{
    public function handle($request, Closure $next)
    {
        // without session
        if ((!request()->has('specialty') || !(request()->filled('specialty')) || (request()->input('specialty') == 0))) {
            return $next($request);
        }

        $specialty = (int) request()->input('specialty');

        if (!empty($specialty)) {
            request()->session()->put('specialty', $specialty);
        }

        return $next($request)->where('speciality', request()->input('specialty'));
    }
}
