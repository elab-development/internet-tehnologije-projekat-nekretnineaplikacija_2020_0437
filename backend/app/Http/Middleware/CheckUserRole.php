<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles): Response
    {
        return $next($request);

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
