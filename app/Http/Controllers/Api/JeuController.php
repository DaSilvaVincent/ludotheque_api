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
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Ramsey\Collection\Collection;
use OpenApi\Annotations as OA;

class JeuController extends Controller
{
    protected $faker;

    public function __construct() {
        $this->faker = $this->withFaker();
    }

    protected function withFaker() {
        return Container::getInstance()->make(Generator::class);
    }

    /**
     * Show 5 random games in the database if you are a visitor
     *
     * @OA\Get(
     *     path="/api/jeu/indexVisiteur",
     *     tags={"Jeu"},
     *     @OA\Response(
     *         response="200",
     *         description="Shows 5 random games"
     *     )
     * )
     */
    public function indexJeuVisiteur() {
        $jeux = [];
        $lesIdJeux = Jeu::pluck('id');
        for($i=0;$i<5;$i++) {
            $idRand = $this->faker->randomElement($lesIdJeux);
            $jeux[$i] = Jeu::where('id', '=', $idRand)->get();
            $lesIdJeux->forget($idRand);
        }
        return response()->json(['status' => 'success', 'message' => "Shows 5 random games", 'jeux' => $jeux], 200);
    }

    /**
     * Show all games in the database if you are an adherent according to a minimum age or/and depending on the minimum number of players
     *
     * @OA\Get(
     *     path="/api/jeu/indexAdherent",
     *     tags={"Jeu"},
     *     @OA\Response(
     *         response="200",
     *         description="Shows all the games"
     *     )
     * )
     */
    public function indexJeuAdherent(Request $request) {
        $age_min = $request->input('age_min', -1);
        $nb_joueur_min =  $request->input('nb_joueur_min', -1);
        $sort = $request->input('sort',"asc");
        $jeux = Jeu::where('nombre_joueurs_min', '>=', $nb_joueur_min)->where('age_min', '>=', $age_min);
        $jeux = $jeux->orderBy('nom',$sort);
        return response()->json(['status' => 'success', 'message' => "Shows all the games", 'jeux' => $jeux->get()], 200);

    }

    /**
     * Add a new game if you are at least a premium adherent
     *
     * @OA\Post(
     *     path="/api/jeu/createJeu",
     *     tags={"Jeu"},
     *     @OA\Response(
     *         response="200",
     *         description="Game created successfully!"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error game create"
     *     )
     * )
     */
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

    /**
     * Update the game by his id if you are at least a premium adherent
     *
     * @OA\Put(
     *     path="/api/jeu/updateJeu/id",
     *     tags={"Jeu"},
     *     @OA\Response(
     *         response="200",
     *         description="Game updated successfully!"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error game update"
     *     )
     * )
     */
    public function updateJeu(JeuRequest $request, $id) {
        try {
            $jeu = Jeu::findOrFail($id);
            $jeu->update($request->all());
            return response()->json(['status' => 'success', 'message' => "Game updated successfully!", 'jeu' => $jeu], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => "Error game update", 'error' => $e], 422);
        }
    }

    /**
     * Update the game's URL by his id if you are at least a premium adherent
     *
     * @OA\Put(
     *     path="/api/jeu/updateUrl/id",
     *     tags={"Jeu"},
     *     @OA\Response(
     *         response="200",
     *         description="Game url media updated successfully!"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error Game url media"
     *     )
     * )
     */
    public function updateUrl(Request $request, $id) {
        try {
            $this->validate($request, [
                'url_media' => 'required',
            ]);
            $jeu = Jeu::findOrFail($id);
            $jeu->url_media = "images/".$request->input('url_media');
            $jeu->save();
            return response()->json(['status' => 'success', 'message' => "Game url media updated successfully!", 'url_media' => $jeu->url_media], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => "Error Game url media", 'error' => $e,], 422);
        }
    }

    /**
     * Add a purchase of a game if you are at least a premium adherent
     *
     * @OA\Post(
     *     path="/api/jeu/createAchat",
     *     tags={"Jeu"},
     *     @OA\Response(
     *         response="200",
     *         description="Purchase created successfully!"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error purchase create"
     *     )
     * )
     */
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
            return response()->json(['status' => "success", 'message' => "Purchase created successfully!", 'achat' => $achat]);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => "Error purchase create", 'error' => $e],422);
        }
    }

    /**
     * Delete a purchase of a game by his id if you are at least a premium adherent or the owner of the purchase
     *
     * @OA\Delete(
     *     path="/api/jeu/deleteAchat",
     *     tags={"Jeu"},
     *     @OA\Response(
     *         response="200",
     *         description="Purchase deleted successfully!"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error purchase delete"
     *     )
     * )
     */
    public function deleteAchat($id) {
        try {
            $achat = Achat::findOrFail($id);
            if (Gate::allows('delete-achat',$achat)) {
                $achat->delete();
                return response()->json(['status' => "success", 'message' => "Purchase deleted successfully!"], 200);
            }
        }catch (Exception $e) {
            error_log($e);
            return response()->json(['status' => "error", 'message' => "Error purchase delete", "error" => $e], 422);
        }
    }


    /**
     * Show the details of game find by his id if you are an adherent
     *
     * @OA\Get(
     *     path="/api/jeu/showJeu/id",
     *     tags={"Jeu"},
     *     @OA\Response(
     *         response="200",
     *         description="Full info of game"
     *     )
     * )
     */
    public function showJeu($id) {
            $jeu = Jeu::findOrFail($id);
            $achat = Achat::where('jeu_id', '=' ,$id)->get();
            $commentaire = Commentaire::where('jeu_id', '=' ,$id)->get();
            $like = Like::where('jeu_id', '=', $id)->get();
            $nbLike = count($like);
            return response()->json(['status' => 'success', 'message' => "Full info of game", 'achats' => $achat, 'commentaires' => $commentaire, 'jeu' => $jeu, 'nb_likes' => $nbLike], 200);
    }

}
