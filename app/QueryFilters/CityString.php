<?php

namespace App\QueryFilters;

use App\Models\City;
use Closure;

class CityString
{
    public function handle($request, Closure $next)
    {
        // without sessions
        if ((!request()->has('city') || !(request()->filled('city')))) {
            return $next($request);
        }

        $city = request()->input('city');

        if (!empty($city)) {
            request()->session()->put('city', $city);
        }

        $cityids = City::where('name', 'LIKE', '%' . request()->input('city') . '%')->pluck("id");

        return $next($request)->whereIn(
            'city_id',
            $cityids
        );
    }
}
