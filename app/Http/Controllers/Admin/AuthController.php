<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // Tampilkan form login admin
        return view('admin.loginadmin');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            \Log::info('User logged in:', [
                'id' => $user->id,
                'email' => $user->email,
                'is_admin' => $user->is_admin,
                'role' => $user->role
            ]);
            
            // Cek apakah user adalah admin
            if ($user->is_admin || $user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
                return back()->withErrors(['email' => 'Anda tidak memiliki akses admin']);
            }
        }
        
        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
} 