<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FrontendLocale
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
        if(in_array($request->segment(1), config('constants.multilang')))
            app()->setLocale($request->segment(1));
        else
            app()->setLocale(config('app.locale'));
        return $next($request);
    }
}
