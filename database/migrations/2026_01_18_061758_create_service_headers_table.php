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
        Schema::create('service_headers', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->nullable(); // Enterprise Rigor
            $table->string('heading_main')->nullable(); // Resilient Systems
            $table->string('heading_gradient')->nullable(); // Clear SLAs
            $table->text('description')->nullable(); // Networking...
            $table->json('features')->nullable(); // [{icon: ..., text: ...}, ...]
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_headers');
    }
};
