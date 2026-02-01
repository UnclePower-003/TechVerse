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
        Schema::create('about_expertises', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();         // "Who we are"
            $table->text('description')->nullable();    // Paragraph below
            $table->json('items')->nullable();          // JSON of expertise cards
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_expertises');
    }
};
