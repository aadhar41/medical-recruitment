<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Events\LoginHistory;
use App\Listeners\storeUserLoginHistory;

class IsJobSeeker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user) {
            if ($user->role == 2) {
                return $next($request);
            }
            return redirect("/")->with("info", "This module is only available for job seeker.");
        }
        return redirect("/")->with("info", "This module is only available for job seeker.");
    }
}
