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
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'prenom' => "required|string|between:5,50",
            'pseudo' => "required|string|between:5,50"
        ]);
        $user = User::create([
            'login' => $request['login'],
            'email' => $request['email'],
            'nom' => $request['nom'],
            'prenom' => $request['prenom'],
            'pseudo' => $request['pseudo'],
            'password' => Hash::make($request['password']),
            'valide' => 0,
            'avatar'=>'storages/avatar/avatar.png',
        ]);
        try {
            $token = Auth::login($user);
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user,
                'authorisation' => [
                    'token'=> $token,
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

    public function show(int $id): JsonResponse
        {
            try {
                $adherent = User::findOrFail($id);
                return response()->json([
                    'status' => 'success',
                    'message' => "Profil successfully!",
                    'adherent' => $adherent
                ], 200);
            } catch (Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Error profil",
                    'error' => $e->getMessage()
                ], 403);
            }
}
    public function updateProfile(AdherentRequest $request, $id)
    {
        try {
            $adherent = User::findOrFail($id);
            $adherent->update($request->all());
            return response()->json([
                'status' => 'success',
                'message' => "Adherent updated successfully!",
                'adherent' => $adherent
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => "Error profil",
                'error' => $e
            ], 422);
        }
    }
    public function updateAvatar(AdherentRequest $request, $id)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $adherent = User::findOrFail($id);
        if ($request->user()->hasRole('admin') || $request->user()->id === $adherent->user_id) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file;
            $path = $file->storeAs('public/avatars', $filename);
            $adherent->avatar_url = asset('storage/avatars/' . $filename);
            $adherent->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Adherent avatar updated successfully',
                'url_media' => $adherent->avatar_url
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

}
