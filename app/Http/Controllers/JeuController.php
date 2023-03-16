<?php

namespace App\Http\Controllers;

use App\Http\Requests\JeuRequest;
use App\Http\Resources\JeuRessource;
use App\Models\Jeu;
use Exception;
use Illuminate\Http\Request;

class JeuController extends Controller
{
    public function index(Request $request = null) {
        $jeux = Jeu::all();
        if(!empty($request)) {
            foreach ($jeux as $jeu) {
                if ($request->age_min < $jeu->age_min) {
                    $jeux->forget($jeu);
                }
            }
        }
        return JeuRessource::collection($jeux);
    }

    public function store(JeuRequest $request) {
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
            $jeu->categorie = $request->categorie;
            $jeu->theme = $request->theme;
            $jeu->editeur = $request->editeur;
            $jeu->save();
            return response()->json(['status' => "success", 'message' => "Game created successfully!", 'jeu' => $jeu], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e],422);
        }
    }
}
