<?php

namespace App\Http\Controllers;

class CorpsController extends Controller
{
    public function index()
    {
        $parties = [
            ['nom' => 'Tête', 'image' => 'tete.png', 'son' => 'tete.mp3'],
            ['nom' => 'Main', 'image' => 'main.png', 'son' => 'main.mp3'],
            ['nom' => 'Pied', 'image' => 'pied.png', 'son' => 'pied.mp3'],
            ['nom' => 'Oreille', 'image' => 'oreille.png', 'son' => 'oreille.mp3'],
            ['nom' => 'Nez', 'image' => 'nez.png', 'son' => 'nez.mp3'],
            ['nom' => 'Bouche', 'image' => 'bouche.png', 'son' => 'bouche.mp3'],
            ['nom' => 'Oeil', 'image' => 'oeil.png', 'son' => 'oeil.mp3'],
            ['nom' => 'Jambe', 'image' => 'jambe.png', 'son' => 'jambe.mp3'],
        ];
        return view('corps', compact('parties'));
    }
}
