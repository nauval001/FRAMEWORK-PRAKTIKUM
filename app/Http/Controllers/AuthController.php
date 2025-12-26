<?php
// File: app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Import Fasilitas Autentikasi Laravel
use Illuminate\Support\Facades\Session; // <-- Import Session

class AuthController extends Controller
{
    /**
     * Menampilkan halaman/form login.
     * Dipanggil oleh Rute GET /login
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Mengarahkan ke file resources/views/auth/login.blade.php
    }

    /**
     * Memproses upaya login.
     * Dipanggil oleh Rute POST /login
     */
    public function login(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // 2. Coba lakukan login
        // Ini adalah pengganti "SELECT * FROM user WHERE email=..."
        if (Auth::attempt($credentials)) {
            
            // 3. Jika berhasil, regenerasi session
            $request->session()->regenerate();

            // 4. Arahkan berdasarkan role (sesuai logika login.php native Anda)
            $user = Auth::user();

            if ($user->idrole == 1) { // 1 = Admin
                // Arahkan ke halaman admin
                return redirect()->intended('/admin/jenis-hewan'); 
            } elseif ($user->idrole == 2) { // 2 = Resepsionis
                // TODO: Buat rute dan halaman untuk resepsionis nanti
                return redirect()->intended('/resepsionis/home'); 
            }

            // Jika tidak punya role, arahkan ke home
            return redirect('/');
        }

        // 5. Jika gagal, kembalikan ke form login dengan pesan error
        return back()->with('error', 'Email atau Password salah.');
    }

    /**
     * Memproses logout user.
     * Dipanggil oleh Rute GET /logout
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Logout user

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Arahkan kembali ke Halaman Home
    }
}