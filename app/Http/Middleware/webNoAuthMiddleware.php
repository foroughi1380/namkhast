<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class webNoAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->route()->getPrefix() == RouteServiceProvider::AdminControlPrefix) {
            if (Auth::guard('admin')->check()) {
                return Redirect::to("/ac");
            }
        }
        if (Auth::check()) {
            return Redirect::to("/");
        }

        return $next($request);
    }
}
