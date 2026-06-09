<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Le modèle associé à ce factory.
     */
    protected $model = User::class;

    /**
     * Définis l'état par défaut des données.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Mot de passe par défaut pour tes tests
            'remember_token' => Str::random(10),
            // On laisse 'phone' et 'role' vides ici car ils seront 
            // personnalisés par ton Seeder lors de la création.
        ];
    }
}