<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diupdate!');
    }

    public function allInOne()
    {
        $user = Auth::user();
        $orders = [];
        if ($user) {
            $orders = \App\Models\Order::where('user_id', $user->id)
                ->orderByDesc('created_at')
                ->get();
            // Pastikan setiap order->items berupa array
            foreach ($orders as $order) {
                if (!is_array($order->items)) {
                    $order->items = (array) $order->items;
                }
            }
        }
        return view('profile.all', compact('user', 'orders'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/profile')->with('success', 'Berhasil logout!');
    }
}
