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
        Schema::create('about_headers', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // About Tech Verse
            $table->text('description')->nullable(); // Paragraph
            $table->string('badge_text')->nullable(); // Certified Engineers & Rapid Delivery
            $table->string('badge_icon')->nullable(); // fa-solid fa-certificate
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_headers');
    }
};
