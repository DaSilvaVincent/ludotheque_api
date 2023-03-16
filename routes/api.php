<?php

use App\Http\Controllers\Api\CommentaireController;
use App\Http\Controllers\Api\JeuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('commentaires')->group(function () {
    Route::post('/', [CommentaireController::class, 'create'])
        ->middleware(['auth', 'role:adherent'])
        ->name('commentaires.create');
    Route::put('/{id}', [CommentaireController::class, 'edit'])
        ->middleware(['auth', 'role:commentaire-moderateur'])
        ->name('commentaires.update');
    Route::delete('/{id}', [CommentaireController::class, 'delete'])
        ->middleware(['auth', 'role:commentaire-moderateur'])
        ->name('commentaires.delete');
});

Route::prefix('jeu')->group(function () {
    Route::get('/', [JeuController::class, 'indexJeuVisiteur'])
        ->middleware(['auth', 'role:visiteur'])
        ->name('jeu.indexJeuVisiteur');
    Route::get('/', [JeuController::class, 'indexJeuAdherent'])
        ->middleware(['auth', 'role:adherent'])
        ->name('jeu.indexJeuAdherent');
    Route::post('/createJeu', [JeuController::class, 'storeJeu'])
        ->middleware(['auth', 'role:adherent-premium'])
        ->name('jeu.storeJeu');
    Route::put('/updateJeu/{id}', [JeuController::class, 'updateJeu'])
        ->middleware(['auth', 'role:adherent-premium'])
        ->name('jeu.updateJeu');
    Route::put('/updateUrl/{id}', [JeuController::class, 'updateUrl'])
        ->middleware(['auth', 'role:adherent-premium'])
        ->name('jeu.updateUrl');
    Route::post('/createAchat', [JeuController::class, 'storeAchat'])
        ->middleware(['auth', 'role:adherent-premium'])
        ->name('jeu.storeAchat');
    Route::post('/showJeu/{id}', [JeuController::class, 'showJeu'])
        ->middleware(['auth', 'role:adherent'])
        ->name('jeu.showJeu');

});

Route::controller(\App\Http\Controllers\Api\AdherentControlleur::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});

Route::controller(\App\Http\Controllers\Api\AuthController::class)->group(function(){
    Route::post('login','login');
    Route::post('register','register');
    Route::post('logout','logout');
    Route::post('refresh','refresh');
});
