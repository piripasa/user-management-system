<?php

namespace App\Http\Middleware;

use App\Exceptions\UnAuthorizedException;

class GroupMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next, $group)
    {
        if(!$request->user->hasGroup($group)) {
            throw new UnAuthorizedException("Unauthorized");
        }

        return $next($request);
    }
}