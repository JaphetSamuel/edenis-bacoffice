<?php

namespace App\Http\Controllers\Pack;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $portefeuille = auth()->user()->portefeuille;
        // display formulaire d'achat de pack
        return view('modules.packs.create', [
            'packs' => \App\Models\Pack::all(),
            'user' => auth()->user(),
            'portefeuille' => $portefeuille,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //after ValidationAchatPack
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
