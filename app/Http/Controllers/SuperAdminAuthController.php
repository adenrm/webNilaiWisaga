<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Superadmin;
use Illuminate\Support\Facades\Hash;

class SuperAdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('superadmin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('superadmin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('superadmin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password yang dimasukkan tidak sesuai.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('superadmin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
} 