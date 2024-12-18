<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        $data = [
            'title' => 'Login | E-Procurement'
        ];

        return view('auth/login', $data);
    }

    public function login(Request $req)
    {
        $validData = $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($validData)) {
            return redirect()->intended('dashboard');
        }

        return redirect()->back()->withErrors(['error' => 'Email or password incorrect']);
    }

    public function logout(Request $req)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
