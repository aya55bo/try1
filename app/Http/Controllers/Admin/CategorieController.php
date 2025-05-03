<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $categories = \App\Models\Categorie::all();
    return view('admin.categories.index', compact('categories'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retourner la vue pour créer une catégorie
        return view('admin.categories.create'); // Assure-toi que cette vue existe
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:255'
    ]);

    \App\Models\Categorie::create([
        'nom' => $request->nom,
    ]);

    return redirect()->route('admin.categories.index')->with('success', 'Catégorie ajoutée avec succès !');
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
