<?php

namespace App\Http\Middleware;

use Closure;

class IsRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $roles = $request->route()->getAction('roles');
        if (auth()->check()&& (auth()->user()->hasAnyRoles($roles) || !$roles)) {
            return $next($request);
        }
        return redirect('/');

    }
}
