<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function update(Request $request)
    {
        // 1. Validation : on s'assure que les données sont bien présentes
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // 2. Récupérer l'utilisateur connecté
        $user = Auth::user();

        // 3. Accéder à la relation 'artisanProfile' définie dans ton modèle User
        $profile = $user->artisanProfile;

        if (!$profile) {
            return response()->json(['message' => 'Profil artisan non trouvé pour cet utilisateur'], 404);
        }

        // 4. Mise à jour des coordonnées
        $profile->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'last_active_at' => now(), // Mise à jour de l'horodatage
        ]);

        return response()->json(['message' => 'Localisation mise à jour avec succès']);
    }
}
