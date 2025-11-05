<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Auth\Request;
use App\Http\Controllers\Auth\Auth;
use Illuminate\Http\RedirectResponse;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
      public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->idrole == 1) { // 1 = Admin
                return redirect()->intended('/admin/jenis-hewan');
            } elseif ($user->idrole == 2) { // 2 = Resepsionis
                return redirect()->intended('/resepsionis/home');
            }

            return redirect('/');
        }

        return back()->with('error', 'Email atau Password salah.');
    }
}
