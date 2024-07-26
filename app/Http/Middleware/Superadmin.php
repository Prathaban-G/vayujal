<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class Superadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('Superadmin Middleware Executed');

        if (Auth::check()) {
            Log::info('User Type: ' . Auth::user()->type);
        } else {
            Log::info('User not authenticated');
        }

        if (Auth::check() && Auth::user()->type !== 'superadmin') {
            return redirect('/');
        }
        return $next($request);
    }
}
