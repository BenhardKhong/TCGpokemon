<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // =========================
    // TAMPILKAN HALAMAN LOGIN
    // =========================
    public function loginForm()
    {
        return view('auth.login');
    }

    // =========================
    // TAMPILKAN HALAMAN REGISTER
    // =========================
    public function registerForm()
    {
        return view('auth.register');
    }

    // =========================
    // PROSES REGISTER
    // =========================
    public function register(Request $request)
    {
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login');
    }

    // =========================
    // PROSES LOGIN
    // =========================
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if($user && Hash::check($request->password, $user->password))
        {
            session([
                'user_id' => $user->id,
                'username' => $user->username,
                'is_admin' => (bool) $user->is_admin
            ]);

            return redirect('/');
        }

        return back()->with('error', 'Email atau password salah');

        return back()->with('error', 'Email atau password salah');
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout()
    {
        session()->flush();

        return redirect('/login');
    }
}