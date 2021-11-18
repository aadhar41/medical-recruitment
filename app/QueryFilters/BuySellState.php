<?php

namespace App\QueryFilters;

use Closure;
use Session;

class BuySellState
{
    public function handle($request, Closure $next)
    {
        // without session
        if ((!request()->has('states') || !(request()->filled('states')))) {
            return $next($request);
        }

        $state = (int) request()->input('states');

        if (!empty($state)) {
            request()->session()->put('states', $state);
        }

        return $next($request)->where('state_id', $state);
    }
}
