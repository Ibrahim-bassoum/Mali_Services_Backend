<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('artisan_profiles', function (Blueprint $table) {
        $table->id();
        
        // 1. LIEN AVEC L'UTILISATEUR
        // Si l'utilisateur est supprimé, son profil d'artisan disparaît aussi
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        // 2. LIEN AVEC LA CATÉGORIE (Son métier principal)
        $table->foreignId('category_id')->constrained();

        // 3. INFORMATIONS PROFESSIONNELLES
        $table->text('bio')->nullable(); // Présentation de l'artisan
        $table->string('experience_years')->default('0'); 
        $table->string('skills')->nullable(); // Liste de compétences (ex: "Soudure, Ferronnerie")
        $table->boolean('is_available')->default(true);

        // 4. LOCALISATION & VÉRIFICATION
        $table->string('base_location')->nullable(); // Son quartier principal (ex: "Kalaban Koro")
        $table->boolean('is_verified')->default(false); // Validé par l'admin après vérification des diplômes
        $table->decimal('rating_average', 3, 2)->default(0.00); // Note moyenne calculée automatiquement
        
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artisan_profiles');
    }
};
