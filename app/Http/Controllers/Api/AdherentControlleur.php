<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdherentRequest;
use App\Http\Resources\AdhrentResource;
use App\Models\User;
use Exception;
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
        try {
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user,
                'authorisation' => [
                    'type' => 'bearer',
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e
            ],422
            );
        }
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

    /**
     * @param int $id
     * @return bool
     */
    public function demandeProfil(int $id) : bool
    {
        $adherent = User::findOrFail($id);
        return  new AdhrentResource($adherent) && response()->json([
            'status'=> true,
            'message' => "Profil utilisateur successfully!",
            'salle' => $adherent
        ],200);
    }
}
