<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
      
        $categories = [
            // --- BÂTIMENT & TRAVAUX ---
            ['name' => 'Plomberie', 'icon' => 'water_drop'],
            ['name' => 'Électricité', 'icon' => 'bolt'],
            ['name' => 'Maçonnerie & Carrelage', 'icon' => 'foundation'],
            ['name' => 'Menuiserie & Aluminium', 'icon' => 'handyman'],
            ['name' => 'Peinture & Déco', 'icon' => 'format_paint'],
            ['name' => 'Soudure & Ferronnerie', 'icon' => 'hardware'],

            // --- TECHNIQUE & FROID ---
            ['name' => 'Froid & Climatisation', 'icon' => 'ac_unit'],
            ['name' => 'Mécanique (Auto/Moto)', 'icon' => 'settings'],
            ['name' => 'Réparation Électronique', 'icon' => 'tv'],
            ['name' => 'Informatique & Mobile', 'icon' => 'smartphone'],

            // --- BEAUTÉ & BIEN-ÊTRE (Ta nouvelle suggestion) ---
            ['name' => 'Coiffure & Barbier', 'icon' => 'content_cut'],
            ['name' => 'Soins du corps & Massage', 'icon' => 'spa'],
            ['name' => 'Maquillage & Henné', 'icon' => 'brush'],
            ['name' => 'Manucure & Pédicure', 'icon' => 'back_hand'],

            // --- SERVICES MÉNAGERS ---
            ['name' => 'Nettoyage & Vitres', 'icon' => 'cleaning_services'],
            ['name' => 'Blanchisserie (Pressing)', 'icon' => 'local_laundry_service'],
            ['name' => 'Cuisine & Traiteur', 'icon' => 'restaurant'],
            ['name' => 'Entretien Piscine & Jardin', 'icon' => 'pool'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => Str::slug($cat['name'])], // Évite les doublons si on relance
                [
                    'name' => $cat['name'],
                    'icon' => $cat['icon'],
                    'is_active' => true,
                ]
            );
        }
    }
}