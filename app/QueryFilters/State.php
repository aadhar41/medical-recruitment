<?php

namespace App\QueryFilters;

use Closure;
use Session;

class State
{
    public function handle($request, Closure $next)
    {
        // without session
        if ((!request()->has('states') || !(request()->filled('states')) || (request()->input('states') == 0))) {
            return $next($request);
        }

        $state = (int) request()->input('states');

        if (!empty($state)) {
            request()->session()->put('states', $state);
        }

        return $next($request)->where('state', $state);
    }
}
