<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentaireRequest;
use App\Models\Commentaire;
use Exception;
use http\Client\Request;
use Illuminate\Http\JsonResponse;

class CommentaireController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  CommentaireRequest $request
     * @return JsonResponse
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
            $commentaire = Commentaire::find($id);
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
    public function delete($id){
        try {
            $commentaire = Commentaire::find($id);
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
