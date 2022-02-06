<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function login_post(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $login = $request->only(['email', 'password']);
        $user = User::where('email', $request->email)->where("status","1")->first();
        if ($user){
            if (Auth::attempt($login)){
                return redirect()->route('index')->with('success',true);
            }else{
                return redirect()->back()->withInput()->with('error',true);
            }
        }else{
            return redirect()->back()->withInput()->with('error',true);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
