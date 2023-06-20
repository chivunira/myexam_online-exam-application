<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == '0') {
                // 1 -> student
                // 2 -> lecturer
                // 0 -> admin
                return $next($request);
            } else if (Auth::user()->role_as == '2') {
                return redirect('lecturer/dashboard')->with('message', 'Access denied. You are not an admin');
            } else {
                return redirect('student/dashboard')->with('message', 'Access denied. You are not an admin');
            }
        } else {

            return redirect('/')->with('message', 'Please login first');
        }
    }
}
