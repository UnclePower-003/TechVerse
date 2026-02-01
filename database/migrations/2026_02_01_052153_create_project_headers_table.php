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
        Schema::create('project_headers', function (Blueprint $table) {
            $table->id();
            $table->string('small_title')->nullable(); // PROJECT PORTFOLIO
            $table->string('main_title'); // Projects
            $table->text('description')->nullable();
            $table->json('badges')->nullable(); // last div (JSON)
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_headers');
    }
};
