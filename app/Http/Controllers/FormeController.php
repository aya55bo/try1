<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormeController extends Controller
{
    public function index()
    {
        $formes = [
            ['nom' => 'Cercle', 'image' => 'cercle.png', 'son' => 'cercle.mp3'],
            ['nom' => 'Carré', 'image' => 'carre.png', 'son' => 'carre.mp3'],
            ['nom' => 'Triangle', 'image' => 'triangle.png', 'son' => 'triangle.mp3'],
            ['nom' => 'Rectangle', 'image' => 'rectangle.png', 'son' => 'rectangle.mp3'],
            ['nom' => 'Étoile', 'image' => 'etoile.png', 'son' => 'etoile.mp3'],
            ['nom' => 'Coeur', 'image' => 'coeur.png', 'son' => 'coeur.mp3'],
            ['nom' => 'Hexagone', 'image' => 'hexagone.png', 'son' => 'hexagone.mp3'],
            ['nom' => 'Losange', 'image' => 'losange.png', 'son' => 'losange.mp3'],
            ['nom' => 'Pentagone', 'image' => 'pentagone.png', 'son' => 'pentagone.mp3'],
            ['nom' => 'Trapèze', 'image' => 'trapeze.png', 'son' => 'trapeze.mp3'],
        ];

        return view('formes', compact('formes'));
    }
}
