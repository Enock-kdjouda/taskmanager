<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request){
        $data = $request->validated();
        $user = User::create([
          'name'     => $data['name'],
          'email'    => $data['email'],
          'password' => Hash::make($data['password']),
          'role'     => $data['role'],           // <- on enregistre le rôle
        ]);
        Auth::login($user);
        return redirect()->route('auth.login');
    }
}
