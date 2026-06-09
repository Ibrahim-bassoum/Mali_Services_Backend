<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ArtisanProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB; // Ajouté pour la sécurité des données

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // 1. Validation ajustée (Client + Pro)
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'firstname' => 'required_if:role,pro|string|max:255', // Requis pour le design Pro
            'birth_date' => 'required_if:role,pro|date',         // Requis pour le design Pro
            'phone' => 'required|string|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:client,pro',
            
            // Validation spécifique au profil Pro (Etape 3 du design)
            'category_id' => 'required_if:role,pro|exists:categories,id',
            'experience_years' => 'required_if:role,pro',
            'intervention_zone' => 'required_if:role,pro',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // On utilise une transaction pour éviter de créer un user si le profil pro plante
            return DB::transaction(function () use ($request) {
                
                // 2. Création de l'utilisateur
                $user = User::create([
                    'name' => $request->name,
                    'firstname' => $request->firstname, // Ajouté
                    'birth_date' => $request->birth_date, // Ajouté
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                ]);

                // 3. Création du profil Artisan (avec les champs de ton design)
                if ($user->role === 'pro') {
                    ArtisanProfile::create([
                        'user_id' => $user->id,
                        'category_id' => $request->category_id,
                        'experience_years' => $request->experience_years ?? 0,
                        'base_location' => $request->intervention_zone, // Lié à ta migration
                        'skills' => $request->specialty,               // Lié à ta migration
                        'is_available' => true,
                    ]);
                }

                // 4. Token
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'user' => $user->load('artisanProfile'), // Charge le profil si c'est un pro
                ], 201);
            });

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de la création',
                'error' => $e->getMessage()
            ], 500);
        }
    }

   public function login(Request $request)
{
    $request->validate([
        'phone' => 'required',
        'password' => 'required',
    ]);

    // 1. Chercher l'utilisateur
    $user = User::with('artisanProfile')->where('phone', $request->phone)->first();

    if (!$user) {
        return response()->json(['message' => 'Ce numéro de téléphone n\'existe pas dans la base.'], 401);
    }

    // 2. Vérifier le mot de passe
    if (!Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Mot de passe incorrect pour ce numéro.'], 401);
    }

    // 3. Générer le Token si tout est bon
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
        'user' => $user,
    ]);
}
}