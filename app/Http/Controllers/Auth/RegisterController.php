<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use MongoDB\Client;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        try {
            // Test koneksi MongoDB
            $mongoClient = new Client("mongodb://localhost:27017");
            $database = $mongoClient->tokomonel;
            $collection = $database->users;
            
            Log::info('MongoDB connection test successful');

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6|confirmed',
            ]);

            // Cek email sudah ada atau belum
            $existingUser = $collection->findOne(['email' => $request->email]);
            if ($existingUser) {
                Log::warning('Email already exists:', ['email' => $request->email]);
                return back()->withErrors([
                    'email' => 'Email sudah terdaftar.'
                ])->withInput($request->except('password'));
            }

            // Buat user baru langsung ke MongoDB
            $result = $collection->insertOne([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => false,
                'role' => 'user',
                'created_at' => new \MongoDB\BSON\UTCDateTime(),
                'updated_at' => new \MongoDB\BSON\UTCDateTime()
            ]);

            if ($result->getInsertedCount() > 0) {
                Log::info('User inserted successfully:', ['id' => (string)$result->getInsertedId()]);
                
                // Ambil user yang baru dibuat
                $user = User::find($result->getInsertedId());
                Auth::login($user);
                
                return redirect('/')->with('success', 'Registrasi berhasil!');
            }

            Log::error('Failed to insert user');
            return back()->withErrors([
                'error' => 'Gagal mendaftar. Silakan coba lagi.'
            ])->withInput($request->except('password'));

        } catch (\Exception $e) {
            Log::error('Exception during registration:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withErrors([
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ])->withInput($request->except('password'));
        }
    }
}
