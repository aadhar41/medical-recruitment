<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Events\LoginHistory;
use App\Listeners\storeUserLoginHistory;

class isAdmin
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
            if ($user->role == 1) {
                return $next($request);
            }
            return redirect("/")->with("danger", "This module is only available for Admins.");
        }
        return redirect("/")->with("danger", "This module is only available for medical Admin.");
    }
}
