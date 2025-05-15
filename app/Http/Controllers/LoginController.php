<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(LoginRequest $request){
        if(Auth::attempt($request->only('email','password'), $request->filled('remember'))){
          $request->session()->regenerate();
          return redirect()->intended(route('interface.index'));
        }
        return back()->withErrors(['email'=>'Identifiants invalides'])->onlyInput('email');
      }
      public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
      }
}
