<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role != 'Operator Rumah Sakit' && auth()->user()->role != 'Operator Puskesmas' && auth()->user()->role != 'Super Admin') {
            abort(403);
        }
        return $next($request);
    }
}
