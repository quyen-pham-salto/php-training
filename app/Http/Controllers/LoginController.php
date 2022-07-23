<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function signup(Request $request) {
        if(Auth::check()){
            return redirect('home');
        }
        return view('signup');
    }

    public function signupExec(Request $request) {
        $requests = $request->all();

        $credentials = $request->validate([
            'name' =>  ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        try {
            DB::beginTransaction();

            User::insert([
                'name' => $requests['name'],
                'email' => $requests['email'],
                'password' => Hash::make($requests['password']),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            DB::commit();
           
            if(Auth::attempt($credentials)) {
                return redirect()->route('home');
            }
        } catch(\Exception $e) {
            DB::rollBack();
            return redirect('signup')
                ->withErrors('データ登録失敗');
        }
    }
}
