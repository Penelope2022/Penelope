<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($credentials['email'] === 'admin@example.com' && $credentials['password'] === 'password') {
            $request->session()->put('user', $credentials['email']);
            return redirect('/panel');
        }

        return back()->withErrors(['email' => 'Credenciais inválidas'])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect('/');
    }
}

