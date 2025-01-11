<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class adminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->user_status !== 0) {
            return $next($request);
        }

        return redirect('/'); // Jika bukan admin, arahkan ke dashboard biasa
        // return redirect()->back(); // Jika bukan admin, arahkan ke dashboard biasa
    }
}
