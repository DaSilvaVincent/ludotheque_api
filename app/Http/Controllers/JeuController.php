<?php

namespace App\Http\Controllers;

use App\Http\Resources\JeuRessource;
use App\Models\Jeu;
use Illuminate\Http\Request;

class JeuController extends Controller
{
    public function index()
    {
        $jeux = Jeu::all();
        return JeuRessource::collection($jeux);
    }


}
