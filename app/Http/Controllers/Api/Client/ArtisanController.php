<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\ArtisanProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArtisanController extends Controller
{
    public function index(Request $request)
    {
        // On récupère les profils avec l'utilisateur lié et la catégorie
        $query = ArtisanProfile::with(['user', 'category']);

        // Recherche par nom d'artisan ou spécialité
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%$search%");
                })->orWhere('specialty', 'like', "%$search%");
            });
        }

        // Filtre par catégorie
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        return response()->json([
            'success' => true,
            'data' => $query->get()
        ]);
    }
    public function obtenirArtisansProches(Request $request)
{
    // On récupère la latitude et la longitude envoyées par le client
    $latClient = $request->input('latitude');
    $lngClient = $request->input('longitude');
    
    // On définit le rayon de recherche (par exemple 10 kilomètres)
    $rayon = 10;

    // Requête pour calculer la distance
    $artisans = DB::table('artisan_profiles')
        ->selectRaw("id, latitude, longitude, 
            (6371 * acos(cos(radians(?)) 
            * cos(radians(latitude)) 
            * cos(radians(longitude) - radians(?)) 
            + sin(radians(?)) 
            * sin(radians(latitude)))) AS distance", [$latClient, $lngClient, $latClient])
        ->having("distance", "<", $rayon)
        ->orderBy("distance", "asc")
        ->get();

    return response()->json($artisans);
}


}