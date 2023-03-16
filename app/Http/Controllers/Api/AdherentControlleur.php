<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdherentRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdherentControlleur extends Controller
{

    public function register(AdherentRequest $request) {
        $request->validate([
            'login' => "required|string|between:5,50",
            'email' => "required|string|between:5,50",
            'name' => "required|string|between:5,50",
            'password' => "required|string|between:5,50",
            'prenom' => "required|string|between:5,50",
            'pseudo ' => "required|string|between:5,50"
        ]);
        $user = User::create([
            'login' => $request['login'],
            'email' => $request['email'],
            'name' => $request['name'],
            'prenom' => $request['prenom'],
            'pseudo' => $request['pseudo'],
            'password' => Hash::make($request['password']),
        ]);
        $token = Auth::login($user);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 422);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ],200);
    }

}
