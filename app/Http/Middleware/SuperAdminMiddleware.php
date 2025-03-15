<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('superadmin')->check()) {
            return $next($request);
        }

        return redirect()->route('superadmin.login')->with('error', 'Akses tidak diizinkan. Anda harus login sebagai Super Admin.');
    }
} 