<?php

namespace App\QueryFilters;

use Closure;

class JobType
{
    public function handle($request, Closure $next)
    {
        // without sessions
        if ((!request()->has('jobtype') || !(request()->filled('jobtype')) || (request()->input('jobtype') == 0))) {
            return $next($request);
        }

        $jobtype = (int) request()->input('jobtype');

        if (!empty($jobtype)) {
            request()->session()->put('jobtype', $jobtype);
        }

        return $next($request)->where('job_type', $jobtype);
    }
}
