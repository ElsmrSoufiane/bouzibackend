<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        // Si déjà connecté, rediriger vers admin
        if (Auth::check()) {
            return redirect()->route('admin');
        }
        
        return view('auth.login');
    }
    
    // Traiter la connexion
    public function login(Request $request)
    {
        // Valider les données
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        // Tenter de se connecter
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin');
        }
        
        // Retourner en arrière avec erreur
        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ])->onlyInput('email');
    }
    
    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}