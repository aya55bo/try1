<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
{
    // Valider les informations d'identification
    $credentials = $request->only('email', 'password');

    // Vérifier si les informations d'identification sont valides
    if (Auth::attempt($credentials)) {
        // Authentification réussie, rediriger vers le tableau de bord admin
        return redirect()->route('admin.dashboard');
    } else {
        // Authentification échouée, retourner à la page de login avec un message d'erreur
        return back()->withErrors([
            'email' => 'Les informations d\'identification sont incorrectes.',
        ]);
    }
}


    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
