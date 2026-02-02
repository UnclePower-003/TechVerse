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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('image')->nullable();
            $table->string('badge')->nullable();

            $table->text('overview')->nullable();

            $table->json('project_specifications')->nullable();
            $table->string('completion')->nullable();

            $table->json('key_features')->nullable();

            $table->text('technical_details')->nullable();

            $table->text('quote')->nullable();
            $table->string('quote_author')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
