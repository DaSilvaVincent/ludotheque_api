<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdherentRequest;
use App\Http\Resources\AdhrentResource;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use OpenApi\Annotations as OA;


/**
 * @OA\Tag(
 *     name="Adherent",
 *     description="Adherent operations"
 * )
 */
class AdherentControlleur extends Controller
{
    /**
     * À visitor's connection request.
     *
     * @OA\Post(
     *     path="/api/loginVisitor",
     *     tags={"Adherent"},
     *     summary="logs in a visitor",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Visitor's email and password",
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="user", type="object", description="The logged in user", ref="#/components/schemas/User"),
     *             @OA\Property(property="authorisation", type="object",
     *                 @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."),
     *                 @OA\Property(property="type", type="string", example="bearer")
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Unauthorized")
     *         )
     *     )
     * )
     */
    public function loginVisitor(Request $request): JsonResponse
    {
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
        ], 200);
    }

    /**
     * The request for registration.
     *
     * @OA\Post(
     *     path="/api/registerVisitor",
     *     tags={"Adherent"},
     *     summary="register in a visitor",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Visitor's register",
     *         @OA\JsonContent(
     *             required={"login","nom","email","prenom","pseudo"},
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="login", type="string"),
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="prenom", type="string"),
     *             @OA\Property(property="pseudo", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful register",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="user", type="object", description="The logged in user", ref="#/components/schemas/User"),
     *             @OA\Property(property="authorisation", type="object",
     *                 @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."),
     *                 @OA\Property(property="type", type="string", example="bearer")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Unauthorized")
     *         )
     *     )
     * )
     */
    public function registerVisitor(AdherentRequest $request)
    {
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
            'avatar' => 'storages/avatar/avatar.png',
        ]);
        try {
            $token = Auth::login($user);
            $user->roles()->attach([4]);
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e
            ], 422
            );
        }
    }

    /**
     * A member's disconnection request.
     *
     * @OA\Post(
     *     path="/api/LogoutVisitor",
     *     tags={"Adherent"},
     *     summary="logout in a visitor",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Visitor's logout",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful logout"
     *         )
     *     ),
     *     @OA\Response(
     *         response=40,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Unauthorized")
     *         )
     *     )
     * )
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
     * @OA\Get(
     *     path="/api/{id}",
     *     tags={"Adherent"},
     *     summary="show profil",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Show profil",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful profil",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="user", type="object", description="The logged in user", ref="#/components/schemas/User"),
     *             @OA\Property(property="authorisation", type="object",
     *                 @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."),
     *                 @OA\Property(property="type", type="string", example="bearer")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Unauthorized")
     *         )
     *     )
     * )
     */
    public function show(Request $request, int $id)
    {
        try {
            $adherent = User::findOrFail($id);
            if (Gate::allows('role-adherent', $adherent)) {
                    return response()->json([
                        'status' => 'success',
                        'message' => "Profil successfully!",
                        'adherent' => $adherent
                    ], 200);
                }
            if(Gate::allows('role-admin', $adherent)){
                $adherents = User::all();
                return response()->json([
                    'status' => 'success',
                    'message' => "Profil successfully!",
                    'adherent' => $adherent
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => "Error profil",
                'error' => $e
            ], 403);
        }
    }

    /**
     *  Update the specified resource in storage.
     *
     * @OA\Put(
     *     path="/api/adherent/{id}",
     *     tags={"Adherent"},
     *     summary="Update profil",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Update profil",
     *         @OA\JsonContent(
     *             required={"login","nom","email","prenom","pseudo","password"},
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="login", type="string"),
     *             @OA\Property(property="nom", type="string"),
     *             @OA\Property(property="prenom", type="string"),
     *             @OA\Property(property="pseudo", type="string"),
     *             @OA\Property(property="password", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful update profil",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="user", type="object", description="The logged in user", ref="#/components/schemas/User"),
     *             @OA\Property(property="authorisation", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Unauthorized")
     *         )
     *     )
     * )
     */
    public function updateProfile(AdherentRequest $request, $id)
    {
        try {
            $adherent = User::findOrFail($id);
            $adherent->update($request->all());
            if (Gate::allows('role-adherent', $adherent)) {
                return response()->json([
                    'status' => 'success',
                    'message' => "Adherent updated successfully!",
                    'adherent' => $adherent
                ], 200);
            }
            if (Gate::allows('role-admin', $adherent)) {
                return response()->json([
                    'status' => 'success',
                    'message' => "Adherent updated successfully!",
                    'adherent' => $adherent
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => "Error profil",
                'error' => $e
            ], 422);
        }
    }

    /**
     *  Update the avatar in storage.
     *
     * @OA\Put(
     *     path="/api/adherent/{id}/avatar",
     *     tags={"Adherent"},
     *     summary="Update avatar",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Update avatar",
     *         @OA\JsonContent(
     *             required={"avatar"},
     *             @OA\Property(property="avatar", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful update avatar",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="user", type="object", description="The logged in user", ref="#/components/schemas/User"),
     *             @OA\Property(property="authorisation", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Unauthorized")
     *         )
     *     )
     * )
     */
    public function updateAvatar(Request $request,int $id)
    {
        try {
            $this->validate($request, [
                'avatar' => 'required',
            ]);
            $user = User::findOrFail($id);
            $user->avatar = $request->input('avatar');
            $user->save();
            if (Gate::allows('role-admin', $user)) {
                return response()->json([
                    'status' => 'success',
                    'message' => "Adherent avatar updated successfully!",
                    'url_media' => $user->avatar,
                ], 200);
            }
            if (Gate::allows('role-adherent', $user)) {
                return response()->json([
                    'status' => 'success',
                    'message' => "Adherent avatar updated successfully!",
                    'url_media' => $user->avatar,
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => "Error Avatar",
                'error' => $e,
            ], 422);
        }
    }
}
