<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    User::updateOrCreate(
    ['phone' => '22394184125'], // Si ce numéro existe déjà...
    [
        'name' => 'Ibrahim',    // ...met à jour les autres infos au lieu de recréer.
        'password' => Hash::make('ton_mot_de_passe'),
        'role' => 'admin',
    ]);
    
    }
}
