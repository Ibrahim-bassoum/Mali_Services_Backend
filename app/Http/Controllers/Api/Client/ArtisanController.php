<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\ArtisanProfile;
use Illuminate\Http\Request;

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
}