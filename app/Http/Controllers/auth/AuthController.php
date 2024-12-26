<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Menampilkan form login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Menampilkan form registrasi
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Proses Registrasi
     */
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'admin_code' => 'nullable|string',
        ]);

        $isAdmin = $request->admin_code === '321890';

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $isAdmin ? 'admin' : 'user',
        ]);

        Auth::login($user);

        return redirect()->route($isAdmin ? 'admin.dashboard' : 'user.dashboard');
    }

    /**
     * Proses Login
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('username', 'password'))) {
            $user = Auth::user();
            return redirect()->route($user->role === 'admin' ? 'admin.dashboard' : 'user.dashboard');
        }

        return back()->withErrors(['login' => 'Username atau password salah!']);
    }

    /**
     * Proses Logout
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
