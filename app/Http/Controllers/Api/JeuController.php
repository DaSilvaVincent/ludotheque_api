<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AchatRequest;
use App\Http\Requests\JeuRequest;
use App\Http\Resources\JeuRessource;
use App\Models\Achat;
use App\Models\Commentaire;
use App\Models\Jeu;
use App\Models\Like;
use Exception;
use Illuminate\Http\Request;
use Ramsey\Collection\Collection;

class JeuController extends Controller
{
    public function indexJeuVisiteur() {
        $jeux = Jeu::all();
        $lesJeux = [];
        for ($i=0;$i<5;$i++) {
            $lesJeux[$i] = $jeux[$i];
        }
        return JeuRessource::collection($lesJeux);
    }

    public function indexJeuAdherent(Request $request) {
        $age_min = $request->input('age_min', -1);
        $nb_joueur_min =  $request->input('nb_joueur_min', max(Jeu::pluck('nombre_joueurs_min')->toArray()));
        $sort = $request->input('sort',"asc");
        $jeux = Jeu::where('nombre_joueurs_min', '<=', $nb_joueur_min)->where('age_min', '>=', $age_min)->get();
        if($sort=="desc")
            return JeuRessource::collection($jeux->sortByDesc('nom'));
        else
            return JeuRessource::collection($jeux->sortBy('nom'));
    }

    public function storeJeu(JeuRequest $request) {
        // Ici les données ont été validées dans la classe JeuRequest
        try {
            $jeu = new Jeu();
            $jeu->nom = $request->nom;
            $jeu->description = $request->description;
            $jeu->langue = $request->langue;
            $jeu->url_media = "images/no_image.png";
            $jeu->age_min = $request->age_min;
            $jeu->nombre_joueurs_min = $request->nombre_joueurs_min;
            $jeu->nombre_joueurs_max = $request->nombre_joueurs_max;
            $jeu->duree_partie = $request->duree_partie;
            $jeu->valide = true;
            $jeu->categorie_id = $request->categorie_id;
            $jeu->theme_id = $request->theme_id;
            $jeu->editeur_id = $request->editeur_id;
            $jeu->save();
            return response()->json(['status' => "success", 'message' => "Game created successfully!", 'jeu' => $jeu]);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => "Error game create", 'error' => $e],422);
        }
    }

    public function updateJeu(JeuRequest $request, $id) {
        try {
            $jeu = Jeu::findOrFail($id);
            $jeu->update($request->all());
            return response()->json(['status' => 'success', 'message' => "Game updated successfully!", 'jeu' => $jeu], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => "Error game update", 'error' => $e], 422);
        }
    }

    public function updateUrl(Request $request, $id) {
        try {
            $this->validate($request, [
                'url_media' => 'required',
            ]);
            $jeu = Jeu::findOrFail($id);
            $jeu->url_media = $request->input('url_media');
            $jeu->save();
            return response()->json(['status' => 'success', 'message' => "Game url media updated successfully!", 'url_media' => $jeu->url_media], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => "Error Game url media", 'error' => $e,], 422);
        }
    }

    public function storeAchat(AchatRequest $request) {
        // Ici les données ont été validées dans la classe JeuRequest
        try {
            $achat = new Achat();
            $achat->date_achat = $request->date_achat;
            $achat->lieu_achat = $request->lieu_achat;
            $achat->prix = $request->prix;
            $achat->user_id = $request->user_id;
            $achat->jeu_id = $request->jeu_id;
            $achat->save();
            return response()->json(['status' => "success", 'message' => "Game created successfully!", 'achat' => $achat]);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => "Error game create", 'error' => $e],422);
        }
    }

    public function showJeu($id) {
            $jeu = Jeu::findOrFail($id);
            $achat = Achat::all()->where('jeu_id', '=' ,$id);
            $commentaire = Commentaire::all()->where('jeu_id', '=' ,$id);
            $like = Like::all()->where('jeu_id', '=', $id);
            error_log($like);
            $nbLike = count($like);
            return response()->json(['status' => 'success', 'message' => "Full info of game", 'achats' => $achat, 'commentaires' => $commentaire, 'jeu' => $jeu, 'nb_likes' => $nbLike], 200);
    }

}
