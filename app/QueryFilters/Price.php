<?php

namespace App\QueryFilters;

use Closure;

class Price
{
    public function handle($request, Closure $next)
    {
        if (
            (!request()->has('min') || !(request()->filled('min')) || (request()->input('min') == 0))
            ||
            (!request()->has('max') || !(request()->filled('max')) || (request()->input('max') == 0))
        ) {
            return $next($request);
        }

        $min = (int) request()->input('min');
        $max = (int) request()->input('max');

        if (!empty($min)) {
            request()->session()->put('min', $min);
        }

        if (!empty($max)) {
            request()->session()->put('max', $max);
        }

        return $next($request)->whereBetween('price', [request()->input('min'), request()->input('max')]);
    }
}
