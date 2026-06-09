<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // On appelle les seeders dans le bon ordre chronologique
        $this->call([
            CategorySeeder::class,        // 1. Crée d'abord les catégories (Plomberie, Électricité...)
            ArtisanProfileSeeder::class, 
        // 2. Crée ensuite les 50 utilisateurs et profils artisans associés
        ]);
    }
}