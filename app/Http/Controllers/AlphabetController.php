<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alphabet;

class AlphabetController extends Controller
{
    public function index()
    {
        // On récupère 8 lettres par page
        $alphabets = Alphabet::paginate(10);

        return view('alphabet', compact('alphabets')); // Va vers resources/views/alphabet.blade.php
    }
}
