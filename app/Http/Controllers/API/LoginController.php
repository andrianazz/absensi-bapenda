<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    public function login(Request $request)
    {

        $request->validate([
            'nik' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = request(['nik', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'Unauthorized',
                'message' => 'Invalid credentials',
            ], 401);
        }

        $user = $request->user();

        // $token = $user->createToken('Access Token');

        // $user->access_token = $token->accessToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login success',
            'data' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return response()->json([
            'status' => 'Logged out successfully',
        ]);
    }
}
