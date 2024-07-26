<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use Illuminate\Support\Facades\Log;
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        Log::info('User logged in successfully: ' );
        $request->authenticate();

        $request->session()->regenerate();
        Log::info('User logged in successfully: ' . Auth::user()->username);
        Log::info('User type: ' . Auth::user()->type);

        if ($request->user()->type === 'superadmin') {
            return redirect('superadmin/dashboard');
        }
        elseif($request->user()->type === 'admin')
        {
            return redirect('admin/dashboard');
        } 
        return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
