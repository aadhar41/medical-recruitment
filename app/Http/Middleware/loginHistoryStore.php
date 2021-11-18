<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Events\LoginHistory;
use App\Listeners\storeUserLoginHistory;

class loginHistoryStore
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
        if (isset($user) && !empty($user->id)) {
            event(new LoginHistory($user));
        }

        return $next($request);
    }
}
