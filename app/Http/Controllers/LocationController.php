<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
 public function update(Request $request)
{
    try {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $user = Auth::user();
        
        // Debug : Affichez l'utilisateur pour vérifier qu'il est bien authentifié
        if (!$user) return response()->json(['message' => 'Non authentifié'], 401);

        $profile = \App\Models\ArtisanProfile::where('user_id', $user->id)->first();

        if (!$profile) {
            return response()->json(['message' => 'Profil artisan non trouvé'], 404);
        }

        $profile->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'last_active_at' => now(),
        ]);

        return response()->json(['message' => 'Succès']);

    } catch (\Exception $e) {
        // CELA VA VOUS MONTRER L'ERREUR RÉELLE DANS POSTMAN
        return response()->json([
            'message' => 'Erreur fatale',
            'error' => $e->getMessage() 
        ], 500);
    }
}
}
