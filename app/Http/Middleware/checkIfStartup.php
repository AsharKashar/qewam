<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class checkIfStartup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user =  Auth::user();
        if($user->role != 'start_up'){
            return response()->json(['error' => 'user not of start up role'], 403);
        }
        return $next($request);
    }
}
