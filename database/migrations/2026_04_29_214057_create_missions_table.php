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
         Schema::create('missions', function (Blueprint $table) {
        $table->id();
        // Laravel saura qui est le client via le Token de l'app Client
        $table->foreignId('client_id')->constrained('users'); 
        
        // Ce champ sera vide au début, puis rempli quand un Pro accepte
        $table->foreignId('pro_id')->nullable()->constrained('users');
        
        $table->foreignId('category_id')->constrained();
        
        $table->string('title');
        $table->text('description');
        $table->string('address'); // Lieu de l'intervention à Bamako
        $table->decimal('budget_estimated', 10, 2)->nullable();
        
        // Le statut permet de savoir où on en est sans demander à l'utilisateur
        $table->enum('status', ['pending', 'accepted', 'in_progress', 'completed', 'cancelled'])->default('pending');
        
        $table->timestamps();
    });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
