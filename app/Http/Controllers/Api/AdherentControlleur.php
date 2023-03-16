<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdherentRequest;
use App\Http\Resources\AdhrentRessource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdherentControlleur extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $adhrents = User::all();
        return AdhrentRessource::collection($adhrents);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdherentRequest $request
     *
     */
    public function store(AdherentRequest $request)
    {
        $adhrent = new User();
        $adhrent->login = $request['login'];
        $adhrent->save();





    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
