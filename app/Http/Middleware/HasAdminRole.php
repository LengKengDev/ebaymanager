<?php

namespace App\Http\Middleware;

use Closure;

class HasAdminRole
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
        if ($request->user()->can('views_full')) {
            return $next($request);
        }
        return redirect()->route('home')
            ->with('status', 'You do not have permission to access this page!');
    }
}
