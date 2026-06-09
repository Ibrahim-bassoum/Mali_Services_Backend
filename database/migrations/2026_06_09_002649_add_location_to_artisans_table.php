<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 // Dans ton fichier de migration
public function up(): void
{
    // Utilise le nom de la table en minuscule au pluriel
    Schema::table('artisan_profiles', function (Blueprint $table) { 
        $table->decimal('latitude', 10, 8)->nullable();
        $table->decimal('longitude', 11, 8)->nullable();
        $table->timestamp('last_active_at')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ArtisanProfile', function (Blueprint $table) {
            //
        });
    }
};
