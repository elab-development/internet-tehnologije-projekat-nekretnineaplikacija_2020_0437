<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (!$user) {   
         
            return abort(403, 'Unauthorized');
        }

        foreach ($roles as $role) {
            if ($user->role === $role) {
             
                return $next($request);
            }
        }

        return abort(403, 'Unauthorized');
    }
}
