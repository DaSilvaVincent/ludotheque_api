<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdherentRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdherentControlleur extends Controller
{

    public function __construct() {
        $this->middleware('auth:api', [
            'except' => [
                'login',
                'register'
            ]
        ]);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $essentiel = $request->only('email', 'password');
        $token = Auth::attempt($essentiel);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ],200);
    }


    public function register(AdherentRequest $request) {
        $request->validate([
            'login' => "required|string|between:5,50",
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
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

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out'
        ]);
    }

}
