<?php

namespace App\Http\Controllers;

use App\Models\Chiffre;
use Illuminate\Http\Request;

class ChiffreController extends Controller
{
    public function index()
    {
        $chiffres = Chiffre::orderBy('valeur')->get();
        return view('chiffres.index', compact('chiffres'));
    }
    
    public function show($id)
    {
        $chiffre = Chiffre::findOrFail($id);
        return view('chiffres.show', compact('chiffre'));
    
    }
    public function quiz()
    {
    return view('chiffres.quiz');
    }
    
}
