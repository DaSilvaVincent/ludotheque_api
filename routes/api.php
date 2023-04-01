<?php

use App\Http\Controllers\Api\CommentaireController;
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
