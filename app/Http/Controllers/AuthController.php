<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            // Cek apakah email admin@eco.com
            if ($request->email === 'admin@eco.com') {
                return redirect('/admin'); // Redirect ke Filament admin panel
            }

            // User biasa
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // No need to check admin status here since we want same behavior
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Always redirect to home page with app.blade.php layout
        return redirect('/');  // This will use app.blade.php layout
    }
}
