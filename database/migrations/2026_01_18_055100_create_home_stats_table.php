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
        Schema::create('home_stats', function (Blueprint $table) {
            $table->id();
            $table->string('quantity'); // 10+ Years, 99.9%, 50+
            $table->string('title'); // Experience
            $table->string('description'); // Rapid on-site teams...
            $table->integer('position'); // 1, 2, 3 (fixed order)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_stats');
    }
};
