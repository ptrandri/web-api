<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    protected function generateToken($token)
    {
        return response()->json([
            'token' => $token,
            'user' =>Auth::user()
        ]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Username / Password salah!'], 401);
        }

        return $this->generateToken($token);
    }


    public function get_profile()
    {
        return response()->json(Auth::user());
    }

   
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Anda berhasil logout dari aplikasi.']);
    }
   
    public function refresh()
    {
        return $this->generateToken(Auth::refresh());
    }

    
}