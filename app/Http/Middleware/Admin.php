<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if (!Auth::user()) {
            return redirect(action('AdminLogin@login'));
        }

        if (Auth::user()->type == 0) {
            return redirect(action('AdminLogin@logout'));
        }

        return $next($request);
    }
}
