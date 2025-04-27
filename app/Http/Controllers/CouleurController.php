<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Couleur;

class CouleurController extends Controller
{
    public function index()
    {
        $couleurs = Couleur::all();
        return view('couleurs', compact('couleurs'));
    }
}