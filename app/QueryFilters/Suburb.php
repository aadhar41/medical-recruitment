<?php

namespace App\QueryFilters;

use Closure;

class Suburb
{
    public function handle($request, Closure $next)
    {
        // without session
        if ((!request()->has('suburb') || !(request()->filled('suburb')) || (request()->input('suburb') == 0))) {
            return $next($request);
        }

        $suburb = (int) request()->input('suburb');

        if (!empty($suburb)) {
            request()->session()->put('suburb', $suburb);
        }

        return $next($request)->where('suburb', request()->input('suburb'));
    }
}
