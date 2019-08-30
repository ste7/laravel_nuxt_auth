<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        return User::create(array_merge(
            $request->except('password'),
            ['password' => Hash::make($request->password)]
        ));
    }

    public function login(LoginUserRequest $request)
    {
        if (! auth()->attempt($request->all())) {
            return response()->json([
                'message' => 'Invalid credentials'
            ]);
        }

        $accessToken = auth()->user()->createToken('accessToken')->accessToken;

        return response()->json([
            'user' => auth()->user(),
            'access_token' => $accessToken
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function user(Request $request)
    {
        return response()->json([
            'data' => $request->user()
        ], 200);
    }
}
