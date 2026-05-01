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
           Schema::create('messages', function (Blueprint $table) {
        $table->id();
        $table->foreignId('mission_id')->constrained()->onDelete('cascade');
        $table->foreignId('sender_id')->constrained('users'); // Qui envoie ?
        $table->foreignId('receiver_id')->constrained('users'); // Qui reçoit ?
        
        $table->text('content');
        $table->boolean('is_read')->default(false); // Pour afficher les notifications "non lu"
        $table->timestamps();
    });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
