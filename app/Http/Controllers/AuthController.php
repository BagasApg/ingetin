<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function login_index(){
        return view('auth.login');
    }

    public function login_process(Request $request){
        // dd($request);
        $creds = $request->validate([
            'username' => 'required',
            'password' => "required"
        ]);

        if(Auth::attempt($creds)){
            // dd('logged!');
            $request->session()->regenerate();
            Cookie::queue('selected-id', 0, 10);

            return redirect()->intended('/');
        }
        // dd('woopsies!');
        return back()->with('message', 'Username or password is invalid.');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function register_index(){
        return view('auth.register');
    }

    public function register_process(Request $request){
        // dd($request);
        $request->validate([
            'username' => 'required|min:3|unique:users',
            'password' => 'required|min:3'
        ], [
            'min' => "The :attribute must be at least 3 characters"
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->password = $request->password;
        $user->save();

        return redirect()->route('login-index')->with('registered', 'Registered successfully! Please login to proceed.');
    }
}
