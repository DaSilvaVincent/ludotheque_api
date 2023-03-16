<?php

namespace App\Http\Controllers;

use App\Http\Resources\JeuRessource;
use App\Models\Jeu;
use Illuminate\Database\Eloquent\Collection;
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
}
