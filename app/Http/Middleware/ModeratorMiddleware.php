<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class ModeratorMiddleware
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
        if(!User::isModerator()){
            abort(403,'Whoops, you must be an admin to view this page.');
        }

        return $next($request);
    }
}
