<?php

namespace Database\Factories;

use App\Models\ArtisanProfile;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtisanProfileFactory extends Factory
{
    protected $model = ArtisanProfile::class;

    public function definition(): array
    {
        $quartiersBamako = [
            'Kalaban Coura', 'Sébénikoro', 'Baco Djicoroni', 'Hamdallaye', 
            'Badalabougou', 'Faladié', 'Niamakoro', 'Sotuba', 'Korofina', 'Hippodrome'
        ];

        return [
            // Ces deux IDs seront gérés dynamiquement dans le Seeder
            'user_id' => User::factory(),
            'category_id' => Category::inRandomOrder()->first()->id ?? 1,
            
            'bio' => $this->faker->paragraph(2),
            'experience_years' => (string) $this->faker->numberBetween(1, 20),
            'skills' => implode(', ', $this->faker->words(4)),
            'is_available' => $this->faker->boolean(85), // 85% de chance d'être disponible
            'base_location' => $this->faker->randomElement($quartiersBamako),
            'is_verified' => $this->faker->boolean(60), // 60% vérifiés
            'rating_average' => $this->faker->randomFloat(2, 3, 5), // Note entre 3.00 et 5.00
        ];
    }
}