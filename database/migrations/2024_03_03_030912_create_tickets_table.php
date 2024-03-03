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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade'); // Référence à la réservation
            $table->string('code')->unique(); // Code unique du ticket
            $table->string('status')->default('valid'); // Statut du ticket, par exemple: valid, used, cancelled
            $table->dateTime('expiration_date')->nullable(); // Date d'expiration optionnelle
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
