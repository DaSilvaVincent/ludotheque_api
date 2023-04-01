<?php

namespace App\Http\Controllers;

use App\Http\Requests\JeuRequest;
use App\Http\Resources\JeuRessource;
use App\Models\Jeu;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class JeuController extends Controller
{
    public function index($age_min = null) {
        $jeux = Jeu::all();
        $jeuTrie = new Collection();
        if(!empty($age_min)) {
            foreach ($jeux as $jeu) {
                if ($age_min < $jeu->age_min) {
                    $jeuTrie->add($jeu);
                }
            }
            return JeuRessource::collection($jeuTrie);
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

    public function update(JeuRequest $request, $id) {
        try {
            $jeu = Jeu::findOrFail($id);
            $jeu->update($request->all());
            return response()->json(['status' => "success", 'message' => "Game updated successfully!", 'jeu' => $jeu], 200);
	} catch (Exception $e) {
            return response()->json(['message' => $e],422);
        }
    }
}
