<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role == 'management') {
                return redirect('/management');
            } elseif ($user->role == 'leader') {
                return redirect('/leader');
            } else {
                return redirect('/operator');
            }
        }

        return back()->with('error', 'Login gagal');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}