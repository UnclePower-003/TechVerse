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
        Schema::create('service_lists', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable(); // fa icon class
            $table->string('title')->nullable(); // h3
            $table->string('subtitle')->nullable(); // p small uppercase
            $table->text('description')->nullable(); // main p
            $table->json('tags')->nullable(); // array of tags
            $table->integer('animation_delay')->default(100); // delay-100, 200, etc.
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_lists');
    }
};
