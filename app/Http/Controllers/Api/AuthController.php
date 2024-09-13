<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = User::where('email', $credentials['email'])->first();
            $user->token()->delete();
            $token = $user->createToken($request['email']);

            return response()->json([
                'message' => 'Login Success!',
                'token' => $token->plainTextToken
            ]);
        } else {
            return response()->json([
                'message' => 'The provided credentials do not match our records.'
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logout Success!'
        ]);
    }

    public function guard($guard = 'web')
    {
        return Auth::guard($guard);
    }
}
