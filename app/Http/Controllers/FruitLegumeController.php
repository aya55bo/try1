<?php

namespace App\Http\Controllers;

use App\Models\FruitLegume;
use Illuminate\Http\Request;

class FruitLegumeController extends Controller
{
    public function index()
    {
        $fruitLegumes = FruitLegume::all();
        return view('fruitlegume.index', compact('fruitLegumes'));
    }

    public function exercice()
    {
        $questions = FruitLegume::inRandomOrder()->take(5)->get();

        return view('fruitlegume.exercice', compact('questions'));
    }

    public function resultat(Request $request)
    {
        $reponses = $request->input('reponses', []);
        $solutions = $request->input('solutions', []);

        $score = 0;
        foreach ($reponses as $index => $reponse) {
            if (isset($solutions[$index]) && strtolower(trim($reponse)) == strtolower($solutions[$index])) {
                $score++;
            }
        }

        return view('fruitlegume.resultat', compact('score', 'reponses', 'solutions'));
    }
}
