<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::check()){
            return redirect('home');
        }
        return view('login');
    }

    public function loginExec(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)) {
            return redirect()->route('home');
        }

        return redirect('login')
            ->withErrors($credentials);
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('login');
    }

}
