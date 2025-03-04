<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthManager extends Controller
{
    //
    function login() {
        return view('auth.login');

    }
    function loginPost(Request $request) {
        $request->validate([
            'email' => 'required',
        ]);
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route("home"));
        }
        return redirect(route("login"))->with("error","Invalid Email or Password");
        
    }
    function register(){
        return view('auth.register');
    }
    function registerPost(Request $request){
        $request->validate([
            'name' => 'required',
            'email'=> 'required|email',
            'password'=>'required|min:8',
        ]);
        $user = new User(); 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        if($user->save()){
            return redirect(route("login"))->with("success","Registration Successful");
        }
        return redirect(route("register"))->with("error","Registration Failed");
    }

    function logout(){
        Auth::logout();
        return redirect(route("login"));
    }
}
