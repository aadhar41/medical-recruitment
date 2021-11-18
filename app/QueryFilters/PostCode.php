<?php

namespace App\QueryFilters;

use App\Models\Suburb;
use Closure;

class PostCode
{
    public function handle($request, Closure $next)
    {
        // without session
        if ((!request()->has('postcode') || !(request()->filled('postcode')))) {
            return $next($request);
        }

        $postcode = request()->input('postcode');

        if (!empty($postcode)) {
            request()->session()->put('postcode', $postcode);
        }

        if (is_numeric($postcode)) {
            // is numeric
            $suburbids = Suburb::where('postcode', '=', request()->input('postcode'))->pluck("id");

            return $next($request)->whereIn(
                'suburb_id',
                $suburbids
            );
        }

        $suburbids = Suburb::where('suburb', 'LIKE', '%' . request()->input('postcode') . '%')->pluck("id");
        return $next($request)->whereIn(
            'suburb_id',
            $suburbids
        );

        // return $next($request)->where('suburb', request()->input('postcode'));
        // return $next($request)->with("associatedSuburb")->where('suburb_id', request()->input('postcode'));
        // return $next($request)->with(["associatedSuburb", "associatedSuburb.buysell" => function ($q) use ($postcode) {
        //     $q->where('associatedSuburb.postcode', 'LIKE', '%' . request()->input('postcode') . '%');
        // }]);
        // return $next($request)->with([
        //     'associatedSuburb' =>
        //     fn ($query) => $query
        //         ->where('postcode', 'LIKE', '%' . request()->input('postcode') . '%')
        // ]);
    }
}
