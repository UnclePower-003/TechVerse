<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('about_highlights', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable(); // fa-solid fa-building-shield
            $table->string('title'); // Major Installations
            $table->text('description')->nullable(); // Paragraph
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_highlights');
    }
};
