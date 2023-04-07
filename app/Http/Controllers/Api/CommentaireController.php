<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentaireRequest;
use App\Models\Commentaire;
use Exception;
use http\Client\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use OpenApi\Annotations as OA;

class CommentaireController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  CommentaireRequest $request
     * @return JsonResponse
     */
    /**
     * Add a comment to a game if you are an adherent
     *
     * @OA\Post(
     *     path="/api/commentaires/createCommentaire",
     *     tags={"Commentaires"},
     *     @OA\Response(
     *         response="200",
     *         description="Comment created successfully"
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Error in comment creation"
     *     )
     * )
     */
    public function create(CommentaireRequest $request){
        $request->validate([
            'commentaire' => "required",
            'date_com' => "required",
            'note' => "required",
            'jeu_id' => "required",
            'user_id' => "required",
        ], [
            'required' => 'Le champ :attribute est obligatoire',
        ]);

            $commentaire = Commentaire::create([
                'commentaire' => $request->commentaire,
                'date_com' => $request->date_com,
                'note' => $request->note,
                'jeu_id' => $request->jeu_id,
                'user_id' => $request->user_id,
            ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Client created successfully',
            'comment' => $commentaire,
            ], 200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CommentaireRequest $request
     * @param  int  $id
     * @return JsonResponse
     */
    /**
     * Update the game's comment by his id if you are the owner of the comment or if you are a comment moderator
     *
     * @OA\Put(
     *     path="/api/commentaires/updateCommentaire/id",
     *     tags={"Commentaires"},
     *     @OA\Response(
     *         response="200",
     *         description="Comment updated successfully"
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Error in comment update"
     *     )
     * )
     */
    public function edit(CommentaireRequest $request, int $id){
        $request->validate([
            'commentaire' => "required",
            'date_com' => "required",
            'note' => "required",
            'jeu_id' => "required",
            'user_id' => "required",
        ], [
            'required' => 'Le champ :attribute est obligatoire',
        ]);
        try {
            $commentaire = Commentaire::findOrFail($id);
            if (Gate::allows('edit-commentaire',$commentaire))
                $commentaire->update($request->all());
        } catch (Exception $e) {
            return response()->json([
                'message' => $e
            ],422
            );
        }
        return response()->json([
            'status' => true,
            'message' => "Comment updated successfully",
            'comment' => $commentaire
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  CommentaireRequest $request
     * @return JsonResponse
     */
    /**
     * Delete the comment by his id if you are the owner of the comment or if you are a comment moderator
     *
     * @OA\Delete(
     *     path="/api/commentaires/deleteCommentaire/id",
     *     tags={"Commentaires"},
     *     @OA\Response(
     *         response="200",
     *         description="Comment successfully deleted"
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Error in comment delete"
     *     )
     * )
     */
    public function delete($id){
        try {
            $commentaire = Commentaire::findOrFail($id);
            if (Gate::allows('delete-commentaire',$commentaire))
                $commentaire->delete();
        } catch (Exception $e){
            return response()->json([
                'message' => $e
            ],422
            );
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Comment successfully deleted'
        ],200
        );
    }
}
