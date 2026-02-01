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
        Schema::create('project_qualities', function (Blueprint $table) {
            $table->id();
            $table->string('icon'); // fa-solid fa-layer-group
            $table->string('title'); // Resilient design
            $table->text('description')->nullable();
            $table->integer('delay')->default(800)->nullable(); // transition-delay in ms
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_qualities');
    }
};
