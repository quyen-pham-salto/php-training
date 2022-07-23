<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    public function home(Request $request) {
        $loginUser = Auth::user();
        $userPassword = User::select('password')
            ->where('id', $loginUser->id)
            ->get();
        return view('home')
            ->with('login_user', $loginUser)
            ->with('password', $userPassword);
    }

    public function profile(Request $request) {
        $loginUser = Auth::user();
        return view('profile')
            ->with('login_user', $loginUser);
    }
}
