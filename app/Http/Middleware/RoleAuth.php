<?php

/**
 * @Author Umar A
 * @Class RoleAuthMiddlware
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()) {
            return redirect('/');
        }

        if (Auth::user()->status != ACTIVE) {
            session()->flash('error', 'Not Authorized');
            return redirect('/logout');
        }
        if (!Auth::user()->userRoles) {
            session()->flash('error', 'Not Authorized');
            return redirect('/');
        }

        return $next($request);
    }
}
