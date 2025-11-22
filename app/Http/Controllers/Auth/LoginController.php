<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Ambil data user beserta role aktif
        $user = User::with(['roleUser.role' => function ($query) {
            $query->where('status', 1);
        }])
        ->where('email', $request->input('email'))
        ->first();

        if (!$user) {
            return redirect()->back()
                ->withErrors(['email' => 'Email tidak ditemukan.'])
                ->withInput();
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withErrors(['password' => 'Password salah.'])
                ->withInput();
        }

        // Ambil nama role
        $idRole = $user->roleUser[0]->idrole ?? null;
        $namaRole = Role::where('idrole', $idRole)->first();

        // Login user ke sistem
        Auth::login($user);

        // Simpan session
        $request->session()->put([
            'user_id' => $user->iduser,
            'user_name' => $user->nama,
            'user_email' => $user->email,
            'user_role' => $idRole ?? 'user',
            'user_role_name' => $namaRole->nama_role ?? 'user',
            'user_status' => $user->roleUser[0]->status ?? 'active',
        ]);

        // Arahkan sesuai role
        switch ($idRole) {
            case '1':
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
            case '2':
                return redirect()->route('dokter.dashboard')->with('success', 'Login berhasil!');
            case '3':
                return redirect()->route('perawat.dashboard')->with('success', 'Login berhasil!');
            case '4':
                return redirect()->route('resepsionis.dashboard')->with('success', 'Login berhasil!');
            // default:
            //     return redirect()->route('pemilik.dashboard')->with('success', 'Login berhasil!');
        }
    }
}
