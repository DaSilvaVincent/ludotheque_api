<?php

use App\Http\Controllers\Api\AdherentControlleur;
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
Route::controller(\App\Http\Controllers\Api\AdherentControlleur::class)->group(function () {
    Route::post('loginVisitor', 'loginVisitor');
    Route::post('registerVisitor', 'registerVisitor');
    Route::post('logoutVisitor', 'logoutVisitor');
});
/*
Route::get('/adherent/{id}', [AdherentControlleur::class, 'show']);
Route::put('/adherent/{id}', [AdherentControlleur::class, 'updateProfile']);
Route::put('/adherent/{id}/avatar', [AdherentControlleur::class,'updateAvatar']);
*/

Route::prefix('adherent')->group(function () {
    Route::get('/', [AdherentControlleur::class, 'show'])
        ->middleware(['auth', 'role:admin'])
        ->name('adherent.show');
    Route::put('/{id}', [AdherentControlleur::class, 'updateProfile'])
        ->middleware(['auth', 'role:admin'])
        ->name('adherent.updateProfile');
    Route::put('/{id}/avatar', [AdherentControlleur::class, 'updateAvatar'])
        ->middleware(['auth', 'role:admin'])
        ->name('adherent.updateAvatar');
});
