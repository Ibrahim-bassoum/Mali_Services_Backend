<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ArtisanProfile;
use App\Models\Category; // Assure-toi que cet import est bien présent
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ArtisanProfileSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Récupération des catégories
        $categories = Category::all();

        $this->command->info("Nombre de catégories trouvées par le seeder : " . $categories->count());

        if ($categories->isEmpty()) {
            $this->command->error('Arrêt du seeder : La collection de catégories est vide !');
            return;
        }

        $this->command->info("Début de la création des 50 artisans...");

        // 2. Création des artisans
        for ($i = 1; $i <= 50; $i++) {
            try {
                $fakePhone = '700000' . str_pad($i, 2, '0', STR_PAD_LEFT);

                // Créer l'utilisateur
                $artisanUser = User::create([
                    'name' => "Artisan " . $this->getFakeName($i),
                    'email' => "artisan{$i}@maliservices.com",
                    'phone' => $fakePhone,
                    'password' => Hash::make('password123'),
                    'role' => 'pro', 
                ]);

                // Créer le profil
                ArtisanProfile::factory()->create([
                    'user_id' => $artisanUser->id,
                    'category_id' => $categories->random()->id,
                ]);

            } catch (\Exception $e) {
                $this->command->error("Erreur à l'indice {$i} : " . $e->getMessage());
                return; // Coupe le script pour afficher l'erreur exacte
            }
        }

        $this->command->info("Fin du seeder : 50 artisans créés avec succès !");
    }

    private function getFakeName($index): string
    {
        $prenoms = ['Modibo', 'Adama', 'Bakary', 'Fatoumata', 'Oumar', 'Souleymane', 'Aliou', 'Amadou', 'Idrissa', 'Moussa'];
        $noms = ['Traoré', 'Coulibaly', 'Diallo', 'Diakité', 'Koné', 'Keita', 'Sidibé', 'Tounkara', 'Dembélé', 'Sissoko'];
        
        return $prenoms[$index % 10] . ' ' . $noms[rand(0, 9)];
    }
}