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
use Illuminate\Support\Facades\Storage;

class AdherentControlleur extends Controller
{
    /**
     * A visitor's connection request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function loginVisitor(Request $request) {
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

    /**
     * The request for registration.
     *
     * @param AdherentRequest $request
     * @return JsonResponse
     */
    public function registerVisitor(AdherentRequest $request) {
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
     * A member's disconnection request.
     *
     * @return JsonResponse
     */
    public function logoutVisitor(): JsonResponse
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
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
                'error' => $e
            ], 403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdherentRequest $request
     * @param $id
     * @return JsonResponse
     */
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

    /**
     * Update the avatar in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateAvatar(Request $request,int $id): JsonResponse
    {
        try {
            $this->validate($request, [
                'avatar' => 'required',
            ]);
            $user = User::findOrFail($id);
            $user->avatar = $request->input('avatar');
            $user->save();
            return response()->json([
                'status' => 'success',
                'message' => "Adherent avatar updated successfully!",
                'url_media' => $user->avatar,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => "Error Avatar",
                'error' => $e,
            ], 422);
        }
    }
}
