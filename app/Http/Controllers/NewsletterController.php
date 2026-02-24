<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ], [
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'Veuillez saisir une adresse email valide.',
            'email.unique' => 'Cette adresse email est déjà inscrite à notre newsletter.',
        ]);

        try {
            Subscriber::create([
                'email' => $validated['email'],
                'confirmed_at' => now(), // Confirmation automatique pour l'instant
            ]);

            return back()->with('success', 'Merci ! Vous êtes maintenant inscrit à notre liste de lecteurs.');
        } catch (\Exception $e) {
            Log::error('Erreur Newsletter: ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue lors de votre inscription. Veuillez réessayer plus tard.');
        }
    }
}

