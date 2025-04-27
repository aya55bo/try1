<?php

namespace App\Http\Controllers;

use App\Models\Dessin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DessinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dessins = Dessin::where('user_id', Auth::id())->latest()->get();
        return view('dessin', compact('dessins'));
    }

    public function sauvegarder(Request $request)
    {
        // Validation des données
        $request->validate([
            'image' => 'required',
            'nom' => 'required|string|max:255',
        ]);

        try {
            // Traiter l'image base64
            $image = $this->sauvegarderImage($request->image, $request->nom);
            
            // Créer l'entrée dans la base de données
            $dessin = Dessin::create([
                'nom' => $request->nom,
                'chemin_fichier' => $image,
                'user_id' => Auth::id(),
                'est_partage' => $request->has('partager'),
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Dessin sauvegardé avec succès !',
                'id' => $dessin->id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la sauvegarde : ' . $e->getMessage(),
            ], 500);
        }
    }

    public function partager(Request $request)
    {
        // Validation des données
        $request->validate([
            'image' => 'required',
            'nom' => 'required|string|max:255',
        ]);

        try {
            // Traiter l'image base64
            $image = $this->sauvegarderImage($request->image, $request->nom);
            
            // Créer l'entrée dans la base de données avec le flag "partagé"
            $dessin = Dessin::create([
                'nom' => $request->nom,
                'chemin_fichier' => $image,
                'user_id' => Auth::id(),
                'est_partage' => true,
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Dessin partagé avec succès !',
                'id' => $dessin->id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du partage : ' . $e->getMessage(),
            ], 500);
        }
    }

    private function sauvegarderImage($imageData, $nom)
    {
        // Extraire les données de l'image base64
        $image_parts = explode(";base64,", $imageData);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        
        // Générer un nom de fichier unique
        $fileName = Str::slug($nom) . '-' . time() . '.' . $image_type;
        $path = 'dessins/' . $fileName;
        
        // Sauvegarder l'image dans le stockage
        Storage::disk('public')->put($path, $image_base64);
        
        return $path;
    }
}