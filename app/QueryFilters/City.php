<?php

namespace App\QueryFilters;

use Closure;

class City
{
    public function handle($request, Closure $next)
    {
        // without sessions
        if ((!request()->has('cities') || !(request()->filled('cities')) || (request()->input('cities') == 0))) {
            return $next($request);
        }

        $city = (int) request()->input('cities');

        if (!empty($city)) {
            request()->session()->put('cities', $city);
        }

        return $next($request)->where('city', $city);
    }
}
